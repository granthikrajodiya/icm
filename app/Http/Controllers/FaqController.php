<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ModulePermissionAssignment;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    public function index()
    {
        if (user()->account_type == 1) {
            return redirect()->route('settings', tenant('tenant_id'));
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'));
    }

    public function create()
    {
        return view('faqs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'detail' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first())->with('tab-status', 'faq');
        }

        $faq             = new Faq();
        $faq->title      = $request->title;
        $faq->detail     = $request->detail;
        $faq->created_by = user()->id;
        $faq->save();

        return redirect()->route('settings', tenant('tenant_id'))->with('success', __('FAQ successfully created!'))->with('tab-status', 'faq');
    }

    public function show(Faq $faq)
    {
        return redirect()->route('settings', tenant('tenant_id'));
    }

    public function edit(Faq $faq)
    {
        // $userPerms = $this->checkPerms();
        $userPerms = ModulePermissionAssignment::userPermissions();

        if (user()->account_type == 1 || in_array('FAQ_ALL_CONTENT', $userPerms)) {
            return view('faqs.edit', compact('faq'));
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'));
    }

    public function update(Request $request, Faq $faq)
    {

        // $userPerms = $this->checkPerms();
        $userPerms = ModulePermissionAssignment::userPermissions();

        if (user()->account_type == 1  || in_array('FAQ_ALL_CONTENT', $userPerms)) {
            $validator = Validator::make($request->all(), [
                'title'  => 'required',
                'detail' => 'required',
            ]);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first())->with('tab-status', 'faq');
            }

            $faq->title      = $request->title;
            $faq->detail     = $request->detail;
            $faq->created_by = user()->id;
            $faq->save();

            return redirect()->route('settings', tenant('tenant_id'))->with('success', __('FAQ successfully updated!'))->with('tab-status', 'faq');
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'))->with('tab-status', 'faq');
    }

    public function destroy(Faq $faq)
    {
        // $userPerms = $this->checkPerms();
        $userPerms = ModulePermissionAssignment::userPermissions();

        if (user()->account_type == 1 || in_array('FAQ_ALL_CONTENT', $userPerms)) {
            $faq->delete();

            return redirect()->route('settings', tenant('tenant_id'))->with('success', __('FAQ successfully deleted.'))->with('tab-status', 'faq');
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'))->with('tab-status', 'faq');
    }

    public function helpCenter()
    {
        $faqs = Faq::all();

        return view('faqs.help_center', compact('faqs'));
    }


}
