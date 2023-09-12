<?php

namespace App\Http\Controllers;

use App\Models\ModulePermissionAssignment;
use App\Models\Navigation;
use App\Models\Newsfeeds;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Response;
use Storage;

class NewsfeedsController extends Controller {

    public function create() {
        $userPerms = ModulePermissionAssignment::userPermissions();
        $tenants   = [];

        if (user()->account_type == User::INTERNAL_TENANT_ADMIN || in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms)) {
            $sorted  = Tenant::all()->sortBy('company_name');
            $tenants = $sorted->values()->all();
        }
        return view('news.create', compact('tenants', 'userPerms'));
    }

    public function edit(Newsfeeds $newsfeed) {

        $userPerms = ModulePermissionAssignment::userPermissions();
        $tenants   = [];

        if (user()->account_type == 1 || in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms)) {
            $image = explode('uploads/news/', $newsfeed->image);
            if (!empty($image[1])) {
                $newsfeed->image_name = $image[1];
            } else {
                $newsfeed->image_name = '';
            }

            $sorted  = Tenant::all()->sortBy('company_name');
            $tenants = $sorted->values()->all();
            if ($newsfeed->tenants == NULL) {
                $newsfeed->selected = 'none';
            } else if ($newsfeed->tenants == 'ALL') {
                $newsfeed->selected = 'post_all_tenants';
            } else {
                $newsfeed->selected = 'post_selected_tenants';
            }

            return view('news.edit', compact('newsfeed', 'tenants', 'userPerms'));

        }elseif(user()->account_type == User::EXTERNAL_TENANT_ADMIN){

            $image = explode('uploads/news/', $newsfeed->image);
            if (!empty($image[1])) {
                $newsfeed->image_name = $image[1];
            } else {
                $newsfeed->image_name = '';
            }

            return view('news.edit', compact('newsfeed', 'tenants', 'userPerms'));
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'))->with('tab-status', 'news-feed');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'title'                    => 'required',
            'detail'                   => 'required',
            'file'                     => 'mimes:jpeg,jpg,png,gif',
            'featured_image_placement' => 'required',
            'excerpt_length'           => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->route('settings', tenant('tenant_id'))->with('error', $messages->first())->with('tab-status', 'news-feed');
        }

        $newsfeeds = new Newsfeeds();
        $flag      = false;

        if ($request->file('file')) {
            try {

                $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

                if ($receiver->isUploaded() === false) {
                    throw new UploadMissingFileException();
                }

                $save = $receiver->receive();

                if ($save->isFinished()) {

                    $fileName = rand(4, 4) . time() . '_news' . '.' . $request->file('file')->getClientOriginalName();
                    \Storage::disk('public')->putFileAs('uploads/news/', $save->getFile(), $fileName);

                    $newsfeeds->image = 'uploads/news/' . $fileName;
                    $flag             = true;
                }

            } catch (\Exception$e) {

                Session::put('tab-status', 'news-feed');
                Session::put('error', __('Error on creating the post'));

                return response()->json([
                    "redirect_route" => route('settings', tenant('tenant_id')),
                ]);

            }
        } else {
            $flag = true;
        }

        if ($flag) {
            $newsfeeds->title           = $request->title;
            $newsfeeds->detail          = $request->detail;
            $newsfeeds->image_placement = $request->featured_image_placement;
            $newsfeeds->created_by      = user()->id;
            $newsfeeds->excerpt_length  = $request->excerpt_length;
            $newsfeeds->tenants         = $request->has('tenants') ? $request->tenants : user()->tenant_id;
            $newsfeeds->save();

            //dropzone receiver
            if ($request->file('file')) {

                Session::put('tab-status', 'news-feed');
                Session::put('success', __('Post successfully created!'));

                return response()->json([
                    "redirect_route" => route('settings', tenant('tenant_id')),
                ]);

            } else {

                //render blade
                return redirect()->route('settings', tenant('tenant_id'))->with('success', __('Post successfully created.'))->with('tab-status', 'news-feed');
            }

        } else {
            return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Error on uploading the file'))->with('tab-status', 'news-feed');
        }

    }

    public function show($id) {

        Newsfeeds::getAllNewsfeedsIdsByTenant();
        $newsfeed = Newsfeeds::where('id', $id)->first();

        return view('news.show', compact('newsfeed'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsfeeds  $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsfeeds $newsfeed) {

        $userPerms = ModulePermissionAssignment::userPermissions();

        if (user()->account_type == 1 || in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms) || user()->account_type == User::EXTERNAL_TENANT_ADMIN) {

            $validator = Validator::make($request->all(), [
                'title'                    => 'required',
                'detail'                   => 'required',
                'featured_image_placement' => 'required',
                'excerpt_length'           => 'required|numeric',
            ]);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return response()->json([
                    "is_success" => false,
                    "message"    => $messages->first(),
                ]);

                return redirect()->route('settings', tenant('tenant_id'))->with('error', $messages->first())->with('tab-status', 'news-feed');
            }

            $flag = false;
            $path = storage_path('app/public/' . $newsfeed->image);

            if ($request->hasFile('file')) {

                try {

                    if (!empty($newsfeed->image) && file_exists($path)) {
                        \File::delete($path);
                    }

                    $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

                    if ($receiver->isUploaded() === false) {
                        throw new UploadMissingFileException();
                    }

                    $save = $receiver->receive();

                    if ($save->isFinished()) {

                        $fileName = rand(4, 4) . time() . '_news' . '.' . $request->file('file')->getClientOriginalName();
                        \Storage::disk('public')->putFileAs('uploads/news/', $save->getFile(), $fileName);

                        $newsfeed->image = 'uploads/news/' . $fileName;

                        $flag = true;
                    }

                } catch (\Exception$e) {

                    Session::put('tab-status', 'news-feed');
                    Session::put('error', __('Error on updating the post'));

                    return response()->json([
                        "redirect_route" => route('settings', tenant('tenant_id')),
                    ]);
                }

            } else {

                //checker if they updated and removed image
                // and image isnt the same
                if (!empty($newsfeed->image) && file_exists($path) && $newsfeed->image !==$request->old_image_url ) {
                    \File::delete($path);
                    $newsfeed->image           = null;
                }
                $flag = true;
            }

            if ($flag) {
                $newsfeed->title           = $request->title;
                $newsfeed->detail          = $request->detail;
                $newsfeed->image_placement = $request->featured_image_placement;
                $newsfeed->excerpt_length  = $request->excerpt_length;
                $newsfeed->tenants         = $request->has('tenants') ? $request->tenants : user()->tenant_id;
                $newsfeed->save();

                //dropzone receiver
                if ($request->file('file')) {

                    Session::put('tab-status', 'news-feed');
                    Session::put('success', __('Post successfully updated!'));

                    return response()->json([
                        "redirect_route" => route('settings', tenant('tenant_id')),
                    ]);

                } else {
                    return redirect()->route('settings', tenant('tenant_id'))->with('success', __('Post successfully updated.'))->with('tab-status', 'news-feed');
                }

            } else {
                return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Error on uploading the file'))->with('tab-status', 'news-feed');
            }

        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'))->with('tab-status', 'news-feed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsfeeds  $newsfeeds
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsfeeds $newsfeed) {
        $userPerms = ModulePermissionAssignment::userPermissions();

        if (user()->account_type == 1 || in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms)) {
            $path = storage_path('app/public/' . $newsfeed->image);

            if (!empty($newsfeed->image) && file_exists($path)) {
                \File::delete($path);
            }
            $newsfeed->delete();

            return redirect()->route('settings', tenant('tenant_id'))->with('success', __('Post successfully deleted.'))->with('tab-status', 'news-feed');
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'))->with('tab-status', 'news-feed');
    }

    function list() {

        $navigation = Navigation::where('content_type', 'News Feed')->first();
        if (!empty($navigation)) {
            $title = $navigation->title;
        } else {
            $title = __('News');
        }

        $newsfeeds = Newsfeeds::getNewsfeedListByTenant();
        $nextPage  = $newsfeeds->nextPageUrl();
        Newsfeeds::getAllNewsfeedsIdsByTenant();

        return view('news.list', compact('newsfeeds', 'title', 'nextPage'));
    }

}
