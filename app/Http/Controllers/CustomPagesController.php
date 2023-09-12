<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ModulePermissionAssignment;
use Illuminate\Support\Facades\Session;

class CustomPagesController extends Controller
{
    public function create()
    {
        return view('custom_page.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|unique:custom_pages,title',
            'detail' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first())->with('tab-status', 'customPage-setting');
        }

        $customPages             = new CustomPage();
        $customPages->title      = $request->title;
        $customPages->detail     = $request->detail;
        $customPages->created_by = user()->id;
        $customPages->save();

        return redirect()->route('settings', tenant('tenant_id'))->with('success', __('Custom page successfully created!'))->with('tab-status', 'customPage-setting');
    }

    public function show(CustomPage $customPage)
    {
        return view('custom_page.detail', compact('customPage'));
    }

    public function edit(CustomPage $customPage)
    {
        // $userPerms = $this->checkPerms();
        $userPerms = ModulePermissionAssignment::userPermissions();

        if (user()->account_type == 1 || in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms)) {
            return view('custom_page.edit', compact('customPage'));
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'))->with('tab-status', 'customPage-setting');
    }

    public function update(Request $request, CustomPage $customPage)
    {
        // $userPerms = $this->checkPerms();
        $userPerms = ModulePermissionAssignment::userPermissions();

        if (user()->account_type == 1 || in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms)) {
            $customPage->title  = $request->get('title');
            $customPage->detail = $request->get('detail');
            $customPage->save();

            return redirect()->route('settings', tenant('tenant_id'))->with('success', __('Custom page successfully updated!'))->with('tab-status', 'customPage-setting');
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'))->with('tab-status', 'customPage-setting');
    }

    public function destroy(CustomPage $customPage)
    {
        if (user()->account_type != 1) {
            return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'))->with('tab-status', 'customPage-setting');
        }

        $customPage->delete();

        return redirect()->route('settings', tenant('tenant_id'))->with('success', __('Custom page successfully deleted!'))->with('tab-status', 'customPage-setting');
    }

}
