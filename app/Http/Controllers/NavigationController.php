<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\User;
use App\Models\Newsfeeds;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

/**
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class NavigationController extends Controller {
    public function index() {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            return redirect()->route('settings', tenant('tenant_id'));
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function create() {
        return view('navigation.create');
    }

    public function store(Request $request) {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $rules = [
                'title'        => 'required',
                'content_type' => 'required',
                'icon'         => 'required',
            ];

            if ($request?->content_type != 'Custom HTML') {
                $rules['data_source'] = 'required';
            } else {
                $rules['custom_url'] = 'required';
            }

            $validator = Validator::make(
                $request->all(),
                $rules
            );

            if ($validator->fails()) {
                return response()->json([
                    'is_success' => false,
                    'message'    => $validator->getMessageBag()->first(),
                ]);
            }

            // Check layout_definition_id wise unique title validation
            $fetchUnique = Navigation::where('title', $request->title)->where('layout_definition_id', '=', $request->layout_definition_id)->first();
            if (!empty($fetchUnique)) {
                return response()->json([
                    'is_success' => false,
                    'message'    => __('The title has already been taken.'),
                ]);
            }
            // end validation

            $navigation = Navigation::where('layout_definition_id', '=', $request->layout_definition_id)->orderBy('order_no', 'DESC')->first();

            $post = $request->all();

            if ($request->content_type == 'Custom HTML') {
                $post['data_source'] = $request->custom_url;
            } elseif ($request->content_type == 'Content view' || $request->content_type == 'Workflow view') {
                $post['eform_url'] = $request->eform_url;
            } elseif($request->get('content_type') == 'Single Form'){
                $forms = Utility::getFormMenu();
                $data = null;
                // find data using 'data_source' : temporary container of eForm ID
                foreach ($forms->Data as $index => $form) {
                    if ($form->ID == $request->get('data_source')){
                        $data = $form;
                        break;
                    }
                }
                $post['data_source'] = $data->ID;
                $post['eform_url'] = $data->ViewUrl;
            }

            $post['show_top_menu']        = ($request->show_top_menu) ? 1 : 0;
            $post['show_nav_menu']        = ($request->show_nav_menu) ? 1 : 0;
            $post['adv_config']           = ($request->open_new_window) ? 1 : 0;
            $post['layout_definition_id'] = (isset($request->layout_definition_id) && !empty($request->layout_definition_id)) ? $request->layout_definition_id : 0;
            $post['order_no']             = (!empty($navigation)) ? ($navigation->order_no + 1) : 0;

            Navigation::create($post);

            return response()->json([
                'is_success' => true,
                'message'    => __('Navigation Successfully Added!'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function edit(Navigation $navigation) {
        if (user()->account_type == 1) {
            return view('navigation.edit', compact('navigation'));
        }

        return response()->json(['error' => __('Permission Denied.')]);
    }

    public function update(Request $request, Navigation $navigation) {
        if (user()->account_type == 1) {
            $valid = [
                'title'        => 'required',
                'content_type' => 'required',
            ];

            if (isset($request->content_type) && $request->content_type != 'Custom HTML') {
                $valid['data_source'] = 'required';
            } else {
                $valid['custom_url'] = 'required';
            }

            $validator = Validator::make(
                $request->all(),
                $valid
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return response()->json([
                    'is_success' => false,
                    'message'    => $messages->first(),
                ]);
            }

            // Check layout_definition_id wise unique title validation
            $fetchUnique = Navigation::where('id', '!=', $navigation->id)->where('title', $request->title)->where('layout_definition_id', '=', $navigation->layout_definition_id)->first();

            if (!empty($fetchUnique)) {
                return response()->json([
                    'is_success' => false,
                    'message'    => __('The title has already been taken.'),
                ]);
            }
            // end validation

            $navigation->title          = $request->title;
            $navigation->content_type   = $request->content_type;
            $navigation->data_source    = ($request->content_type == 'Custom HTML') ? $request->custom_url : $request->data_source;
            $navigation->show_top_menu  = ($request->show_top_menu) ? 1 : 0;
            $navigation->show_nav_menu = ($request->show_nav_menu) ? 1 : 0;
            $navigation->adv_config     = ($request->open_new_window) ? 1 : 0;
            if (!empty($request->icon)) {
                $navigation->icon = $request->icon;
            }

            if ($request->content_type == 'Content view' || $request->content_type == 'Workflow view') {
                $navigation->eform_url = $request->eform_url;
            }

            $navigation->save();

            return response()->json([
                'is_success' => true,
                'message'    => __('Navigation Successfully Updated!'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function destroy(Navigation $navigation) {
        if (user()->account_type == 1) {
            $navigation->delete();

            return response()->json([
                'is_success' => true,
                'message'    => __('Navigation Successfully Deleted!.'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function order(Request $request) {
        if (isset($request->ids) && !empty($request->ids)) {
            foreach ($request->ids as $key => $val) {
                Navigation::where('id', '=', $val)->update(['order_no' => $key]);
            }

            return response()->json([
                'is_success' => true,
                'message'    => __('Updated.!'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'),
        ]);
    }

    // Custom HTML Page
    public function customPage(Navigation $navigation) {
        if ($navigation->content_type == 'Custom HTML') {

            $usrData = Session::get('userInfo');
            return view('navigation.custom-page', compact('navigation', 'usrData'));
        }

        return redirect()->back()->with('error', __('Permission Denied.'));
    }



    public function newsfeedPage(Navigation $navigation) {

        if ($navigation->content_type == 'News Feed') {

            //$newsfeeds = Newsfeeds::orderBy('id', 'DESC')->paginate(20);
            $newsfeeds = Newsfeeds::getNewsfeedListByTenant();
            $nextPage  = $newsfeeds->nextPageUrl();

            if(!empty($navigation)){
                $title = $navigation->title;
            }else{
                $title = __('News');
            }

            return view('news.list', compact('newsfeeds','title', 'nextPage'));
        }

        return redirect()->back()->with('error', __('Permission Denied.'));
    }
}
