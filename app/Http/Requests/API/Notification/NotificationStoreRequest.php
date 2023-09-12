<?php

namespace App\Http\Requests\API\Notification;

use App\Http\Requests\API\ApiFormRequest;
use Illuminate\Validation\Rule;

class NotificationStoreRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'api_id'     => ['required'],
            'username'   => ['nullable'],
            'scope'      => ['required', Rule::in(['user', 'tenant', 'system'])],
            'tenant_id'  => ['nullable'],
            'text'       => ['required'],
            'type'       => ['nullable'],
            'link_title' => ['nullable'],
            'link_color' => ['nullable'],
            'link_url'   => ['nullable'],
            'link_type'  => ['nullable'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'scope.in' => 'API scope value is incorrect.',
        ];
    }
}
