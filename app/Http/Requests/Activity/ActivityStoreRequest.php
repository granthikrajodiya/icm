<?php

namespace App\Http\Requests\Activity;

use App\Http\Requests\API\ApiFormRequest;
use App\Models\Activity;
use Illuminate\Validation\Rule;

class ActivityStoreRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'api_id'    => ['required'],
            'username'  => ['required', 'exists:users,username'],
            'type'      => ['required', Rule::in(Activity::TYPES)],
            'date_time' => ['required'],
            'text'      => ['required'],
        ];
    }
}
