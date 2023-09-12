<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulePermissionDef extends Model {

    protected $fillable = [
        'module_name',
        'permission_key',
        'permission_level',
        'permission_description',
    ];

    public const ALL_TENANTS     = 'ALL_TENANTS';
    public const USER_TENANT     = 'USER_TENANT';
    public const PERSONAL        = 'PERSONAL';
    public const HOST_CHAT_USERS = 'HOST_CHAT_USERS';
    public const ALL_CONTENT     = 'ALL_CONTENT';

}
