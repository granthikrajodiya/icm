<?php

namespace App\Http\Controllers;

use App\Models\ModulePermissionAssignment;
use Illuminate\Http\Request;

class ModulePermissionAssignmentController extends Controller {

    public function storePermissions(Request $request) {

        $checked_permissions   = isset($request->checked_permissions) ? json_decode($request->checked_permissions, TRUE) : [];
        $unchecked_permissions = isset($request->unchecked_permissions) ? json_decode($request->unchecked_permissions, TRUE) : [];
        $module_assignments    = isset($request->module_assignments) ? json_decode($request->module_assignments, TRUE) : [];

        if (count($module_assignments) > 0 && count($checked_permissions) > 0) {
            //get the differences and save only those unique
            $diff                = array_diff(array_map('serialize', $checked_permissions), array_map('serialize', $module_assignments));
            $checked_permissions = array_map('unserialize', $diff);
        }

        if (count($checked_permissions) > 0) {
            foreach ($checked_permissions as $perms) {
                $moduleAssignment                   = new ModulePermissionAssignment();
                $moduleAssignment->group_name       = $perms['group_name'];
                $moduleAssignment->module_name      = $perms['module_name'];
                $moduleAssignment->permission_key   = $perms['permission_key'];
                $moduleAssignment->permission_value = $perms['permission_value'];
                $moduleAssignment->save();
            }
        }

        if (count($unchecked_permissions) > 0) {
            foreach ($unchecked_permissions as $perms) {
                $assignment = ModulePermissionAssignment::where('group_name', $perms['group_name'])
                    ->where('module_name', $perms['module_name'])
                    ->where('permission_key', $perms['permission_key'])
                    ->where('permission_value', $perms['permission_value'])
                    ->get();
                if (count($assignment) > 0 ) {
                    $assignment->each(function ($product, $key) {
                            $product->delete();
                        });
                }else{
                    $assignment->delete();
                }
            }
        }
        $permsAssignment = ModulePermissionAssignment::all();

        return response()->json([
            'is_success'      => "true",
            'message'         => __('Permissions Updated Successfully.'),
            'permsAssignment' => $permsAssignment,
        ]);

        // return redirect()->route('settings', tenant('tenant_id'))->with('success', __('Permissions Updated Successfully.'))->with('tab-status', 'permission-layout');

    }

}
