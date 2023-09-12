<?php

namespace App\Http\Requests\Home;

use App\Rules\Home\CheckCurrentPassword;
use App\Rules\Home\NewPasswordIsSameOfCurrent;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password'      => ["required", new CheckCurrentPassword(user())],
            'password'              => ["required", "confirmed", "min:8", new NewPasswordIsSameOfCurrent(user())],
            'password_confirmation' => ["required", "min:8", "same:password"],
        ];
    }
}
