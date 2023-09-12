<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SsoConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'sso_type',
        'login_url',
        'issuer_url',
        'logout_url',
        'certificate_path',
        'key_path',
        'tenant_id',
        'autocreate_authenticated_users',
    ];

    public function tenant()
    {
        return $this->hasOne(Tenant::class, 'id', 'tenant_id');
    }
}
