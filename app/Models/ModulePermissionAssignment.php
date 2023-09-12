<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class ModulePermissionAssignment extends Model {

    protected $fillable = [
        'group_name',
        'module_name',
        'permission_key',
        'permission_value',
    ];


    public static function userPermissions()
    {

        $usrData    = Session::get('userInfo');
        $userGroups      = $usrData->UserGroups ?? [];

        // Checking the settings level on user permissions
        $permsAssignment = ModulePermissionAssignment::all();

        //identifying user permissions
        $userPerms = [];
        foreach ($userGroups as $usg) {
            if (user()->account_type == 1) {
                $userPerms[] = 'CALENDAR_ALL_TENANTS';
                $userPerms[] = 'CHAT_ALL_TENANTS';
                $userPerms[] = 'CUSTOM_PAGES_ALL_CONTENT';
                $userPerms[] = 'FAQ_ALL_CONTENT';
                $userPerms[] = 'NEWS_FEEDS_ALL_CONTENT';
            }
            foreach ($permsAssignment as $perms) {
                if ($perms['group_name'] === $usg) {
                    if ($perms['module_name'] == 'Calendar' && $perms['permission_key'] == 'ALL_TENANTS') {
                        $userPerms[] = 'CALENDAR_ALL_TENANTS';
                    }
                    if ($perms['module_name'] == 'Calendar' && $perms['permission_key'] == 'USER_TENANT') {
                        $userPerms[] = 'CALENDAR_USER_TENANT';
                    }
                    if ($perms['module_name'] == 'Calendar' && $perms['permission_key'] == 'PERSONAL') {
                        $userPerms[] = 'CALENDAR_PERSONAL';
                    }
                    if ($perms['module_name'] == 'Chat' && $perms['permission_key'] == 'ALL_TENANTS') {
                        $userPerms[] = 'CHAT_ALL_TENANTS';
                    }
                    if ($perms['module_name'] == 'Chat' && $perms['permission_key'] == 'HOST_CHAT_USERS') {
                        $userPerms[] = 'CHAT_HOST_CHAT_USERS';
                    }
                    if ($perms['module_name'] == 'Custom Pages' && $perms['permission_key'] == 'ALL_CONTENT') {
                        $userPerms[] = 'CUSTOM_PAGES_ALL_CONTENT';
                    }
                    if ($perms['module_name'] == 'Help & FAQ' && $perms['permission_key'] == 'ALL_CONTENT') {
                        $userPerms[] = 'FAQ_ALL_CONTENT';
                    }
                    if ($perms['module_name'] == 'News Feeds' && $perms['permission_key'] == 'ALL_CONTENT') {
                        $userPerms[] = 'NEWS_FEEDS_ALL_CONTENT';
                    }
                }
            }
        }

        return  $userPerms;

    }
}
