<?php

namespace App\Http\Requests\API\User;

use App\Http\Requests\API\ApiFormRequest;

class UserUpdateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'api_id'                 => ['required'],
            'account_type'           => ['required', 'numeric'],
            'account_status'         => ['required', 'in:active,inactive'],
            'account_status_message' => ['required'],
            'chat_user'              => ['required', 'numeric'],
        ];
    }
}
