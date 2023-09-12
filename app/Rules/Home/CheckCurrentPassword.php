<?php

namespace App\Rules\Home;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CheckCurrentPassword implements Rule
{
    public function __construct(protected User $user)
    {
    }

    public function passes($attribute, $value): bool
    {
        return Hash::check($value, $this->user->password);
    }

    public function message()
    {
        return __("Current Password is Invalid");
    }
}
