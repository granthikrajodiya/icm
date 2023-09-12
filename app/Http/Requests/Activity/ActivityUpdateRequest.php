<?php

namespace App\Http\Requests\Activity;

use App\Http\Requests\API\ApiFormRequest;

class ActivityUpdateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'api_id'    => ['required'],
            'user_id'   => ['required', 'numeric'],
            'type'      => ['required'],
            'date_time' => ['required'],
            'text'      => ['required'],
        ];
    }
}
