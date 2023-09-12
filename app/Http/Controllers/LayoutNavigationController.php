<?php

namespace App\Http\Controllers;

use App\Facades\ILINX;
use App\Models\Layout;
use App\Models\LayoutDefinition;
use App\Models\Navigation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

/**
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class LayoutNavigationController extends Controller
{
    public function create()
    {
        $userGroup = LayoutDefinition::USER_GROUP_NAMES;

        return view('layout_navigation.create', compact('userGroup'));
    }

    public function colorSelect()
    {
        return view('layout_navigation.color_select');
    }

    public function store(Request $request) {

        $fixed_layout = $request->fixed_layout;

        if ($fixed_layout == 1) {

            //fixed layout
            $validate = [
                'title'              => 'required',
                'user_group'         => 'required',
                'top_card_height'    => 'required',
                'middle_card_height' => 'required',
                'bottom_card_height' => 'required',
            ];
        } else {

            //dynamic layout
            $validate = [
                'title'             => 'required',
                'user_group'        => 'required',
                'fixed_layout'      => 'required',
                'navigation_layout' => 'required',
            ];
        }

        $validator = Validator::make(
            $request->all(),
            $validate
        );

        if ($validator->fails()) {
            return redirect()->back()->with([
                'error'      => $validator->errors()->first(),
                'tab-status' => 'layout-navigation-layout',
            ]);
        }

        $securityGroup = null;

        if ($request->user_groups_type == "selected_user_groups") {
            $validatorSecurityGroup = Validator::make(
                $request->all(),
                ['security_group' => 'required']
            );

            if ($validatorSecurityGroup->fails()) {
                return redirect()->back()->with([
                    'error'      => __('Please Select at least one security group.'),
                    'tab-status' => 'layout-navigation-layout',
                ]);
            }
            $securityGroup = json_encode($request->input('security_group'));
        }

        if ($fixed_layout == 1) {

            //fixed layout
            $layoutDefinition = LayoutDefinition::create([
                'title'              => $request->title,
                'user_group'         => $request->user_group,
                'security_groups'    => $securityGroup,
                'user_groups_type'   => 1,
                'navigation_layout'  => $request->navigation_layout,
                'fixed_layout'       => $request->fixed_layout,
                'top_card_height'    => $request->top_card_height,
                'middle_card_height' => $request->middle_card_height,
                'bottom_card_height' => $request->bottom_card_height,
            ]);
        } else {
            //dynamic layout
            $layoutDefinition = LayoutDefinition::create([
                'title'              => $request->title,
                'user_group'         => $request->user_group,
                'security_groups'    => $securityGroup,
                'user_groups_type'   => 1,
                'navigation_layout'  => $request->navigation_layout,
                'fixed_layout'       => $request->fixed_layout,
                'top_card_height'    => null,
                'middle_card_height' => null,
                'bottom_card_height' => null,
            ]);
        }

        Layout::query()
            ->where('layout_definition_id', '=', 0)
            ->update([
                'layout_definition_id' => $layoutDefinition->id,
            ]);

        Navigation::query()
            ->where('layout_definition_id', '=', 0)
            ->update([
                'layout_definition_id' => $layoutDefinition->id,
            ]);

        Session::put('navigation_layout', $layoutDefinition->navigation_layout);

        return redirect()->back()->with('success', __('Layout & Navigation Definition Added Successfully.'))->with(
            'tab-status',
            'layout-navigation-layout'
        );
    }

    public function edit(LayoutDefinition $layoutDefinition)
    {
        $userGroup = LayoutDefinition::USER_GROUP_NAMES;

        return view('layout_navigation.edit', compact('userGroup', 'layoutDefinition'));
    }

    public function update(Request $request, LayoutDefinition $layoutDefinition) {
        $fixed_layout = $request->fixed_layout;

        if ($fixed_layout == 1) {

            //fixed layout
            $validate = [
                'title'              => 'required',
                'user_group'         => 'required',
                'user_groups_type'   => 'required',
                'navigation_layout'  => 'required',
                'top_card_height'    => 'required',
                'middle_card_height' => 'required',
                'bottom_card_height' => 'required',
            ];
        } else {

            //dynamic layout
            $validate = [
                'title'             => 'required',
                'user_group'        => 'required',
                'user_groups_type'  => 'required',
                'navigation_layout' => 'required',
                'fixed_layout'      => 'required',
            ];
        }

        $validator = Validator::make(
            $request->all(),
            $validate
        );

        if ($validator->fails()) {
            return redirect()->back()->with([
                'error'      => $validator->errors()->first(),
                'tab-status' => 'layout-navigation-layout',
            ]);
        }

        $securityGroup = null;

        if ($request->user_groups_type == "selected_user_groups") {
            $validatorSecurityGroup = Validator::make(
                $request->all(),
                ['security_group' => 'required']
            );

            if ($validatorSecurityGroup->fails()) {
                return redirect()->back()->with([
                    'error'      => __('Please Select at least one security group.'),
                    'tab-status' => 'layout-navigation-layout',
                ]);
            }
            $securityGroup = json_encode($request->input('security_group'));
        }

        if ($fixed_layout == 1) {

            //fixed layout
            $layoutDefinition->title              = $request->title;
            $layoutDefinition->user_group         = $request->user_group;
            $layoutDefinition->security_groups    = $securityGroup;
            $layoutDefinition->navigation_layout  = $request->navigation_layout;
            $layoutDefinition->fixed_layout       = $request->fixed_layout;
            $layoutDefinition->top_card_height    = $request->top_card_height;
            $layoutDefinition->middle_card_height = $request->middle_card_height;
            $layoutDefinition->bottom_card_height = $request->bottom_card_height;
            $layoutDefinition->save();

        } else {

            //dynamic layout
            $layoutDefinition->title              = $request->title;
            $layoutDefinition->user_group         = $request->user_group;
            $layoutDefinition->security_groups    = $securityGroup;
            $layoutDefinition->navigation_layout  = $request->navigation_layout;
            $layoutDefinition->fixed_layout       = $request->fixed_layout;
            $layoutDefinition->top_card_height    = null;
            $layoutDefinition->middle_card_height = null;
            $layoutDefinition->bottom_card_height = null;
            $layoutDefinition->save();
        }

        Session::put('navigation_layout', $layoutDefinition->navigation_layout);

        return redirect()->back()->with('success', __('Layout & Navigation Definition Edited Successfully.'))->with(
            'tab-status',
            'layout-navigation-layout'
        );
    }

    public function delete(LayoutDefinition $layoutDefinition)
    {
        if ($layoutDefinition->is_current_layout) {
            return redirect()->back()
                ->with('error', __("You can't delete this layout because you're currently on it."))
                ->with(
                    'tab-status',
                    'layout-navigation-layout'
                );
        }

        if (user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            Layout::query()
                ->where('layout_definition_id', '=', $layoutDefinition->id)
                ->delete();
            Navigation::query()
                ->where('layout_definition_id', '=', $layoutDefinition->id)
                ->delete();

            $layoutDefinition->delete();

            return redirect()->back()
                ->with(
                    'success',
                    __('Layout & Navigation Definition Deleted Successfully.')
                )->with('tab-status', 'layout-navigation-layout');
        }

        return redirect()->back()
            ->with('error', __('Permission Denied.'))
            ->with(
                'tab-status',
                'layout-navigation-layout'
            );
    }

    public function loadView(Request $request)
    {
        $layouts                = [];
        $objUser                = user();
        $selectedSecurityGroups = null;
        $id                     = $request['id'];
        $layout                 = LayoutDefinition::find($id);

        if ($id) {
            $layouts['top'] = Layout::query()
                ->where('layout_definition_id', '=', $id)
                ->where('position', 'LIKE', 'top')
                ->orderBy('order_no', 'ASC')
                ->get();

            $layouts['middle'] = Layout::query()
                ->where('layout_definition_id', '=', $id)
                ->where('position', 'LIKE', 'middle')
                ->orderBy('order_no', 'ASC')
                ->get();

            $layouts['bottom'] = Layout::query()
                ->where('layout_definition_id', '=', $id)
                ->where('position', 'LIKE', 'bottom')
                ->orderBy('order_no', 'ASC')
                ->get();

            $navigations = Navigation::query()
                ->where('layout_definition_id', '=', $id)
                ->orderBy('order_no', 'ASC')
                ->get();

            $layoutDefinition = LayoutDefinition::query()
                ->select('user_group', 'security_groups', 'navigation_layout', 'fixed_layout', 'top_card_height', 'middle_card_height', 'bottom_card_height')
                ->where('id', '=', $id)
                ->first();

            if (!is_null($layoutDefinition)) {
                $selectedSecurityGroups = $layoutDefinition->security_groups;
            }
        } else {
            $layouts['top'] = Layout::query()
                ->where('layout_definition_id', '=', 0)
                ->where('position', 'LIKE', 'top')->orderBy('order_no', 'ASC')
                ->get();

            $layouts['middle'] = Layout::query()
                ->where('layout_definition_id', '=', 0)
                ->where('position', 'LIKE', 'middle')
                ->orderBy('order_no', 'ASC')
                ->get();

            $layouts['bottom'] = Layout::query()
                ->where('layout_definition_id', '=', 0)
                ->where('position', 'LIKE', 'bottom')
                ->orderBy('order_no', 'ASC')
                ->get();

            $navigations = Navigation::query()
                ->where('layout_definition_id', '=', 0)
                ->orderBy('order_no', 'ASC')
                ->get();
        }

        $userGroup = LayoutDefinition::USER_GROUP_NAMES;

        $returnHTML = view(
            'layout_navigation.load_layout',
            compact('layouts', 'navigations', 'selectedSecurityGroups', 'id', 'userGroup', 'layoutDefinition', 'layout')
        )->render();

        $response = [
            'is_success' => true,
            'html'       => $returnHTML,
        ];

        return response()->json($response);
    }

    public function updateLayout($id)
    {
        $objUser                    = user();
        $objUser->layout_definition = $id;
        $objUser->save();

        return redirect()->route('home', tenant('tenant_id'));
    }

    public function getUserSecurityGroup(Request $request) {
        $securityGroup         = ILINX::securityGroup()->setBaseUrl(config('ilinx.ic_url'))->index();
        $securityExternalGroup = ILINX::securityGroup()->setBaseUrl(config('ilinx.ic_url'))->externalGroup();

        if ((!$securityGroup->Success && !$securityExternalGroup->Success) || $request->id == 0) {
            return [];
        }

        $data = [];
        if ($securityGroup->Success) {
            $data = $securityGroup->Data;
        }

        if ($securityExternalGroup->Success) {
            $data = array_merge($data, $securityExternalGroup->Data);
        }

        sort($data);
        return $this->formatSecurityGroups(LayoutDefinition::findOrFail($request->id), $data);
    }

    private function formatSecurityGroups(LayoutDefinition $layoutDefinition, array $securityGroups): array
    {
        $selectedSecurityGroups = json_decode($layoutDefinition->security_groups);
        if (empty($selectedSecurityGroups)) {
            $selectedSecurityGroups = [];
        }
        $response = [];
        foreach ($securityGroups as $value) {
            if (in_array($value->GroupName, $selectedSecurityGroups)) {
                $value->is_select = true;
            }
            $response[] = $value;
        }

        return $response;
    }
}
