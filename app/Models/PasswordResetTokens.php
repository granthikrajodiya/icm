<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PasswordResetTokens extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'tenant_id',
        'token'
    ];

    public function create($user){
        // generate laravel token
        $token = Password::createToken($user);

        $this->token = $token;
        $this->email = $user->email;
        $this->tenant_id = tenant('tenant_id');
        $this->save();

        //delete generated token
        Password::deleteToken($user);

        return $this->token;
    }
}
