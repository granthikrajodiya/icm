<?php

namespace App\Http\Requests\API\Calendar;

use App\Http\Requests\API\ApiFormRequest;
use Illuminate\Validation\Rule;
use App\Models\Calendar;

class EventStoreRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'api_id'      => ['required'],
            'name'        => ['required'],
            'username'    => ['nullable'],
            'tenant_id'   => ['nullable'],
            'scope'       => ['required', Rule::in(['user', 'tenant', 'system'])],
            'all_day'     => ['nullable', Rule::in(1, 0)],
            'timezone'    => ['nullable', 'timezone'],
            'start_time'  => ['nullable'],
            'end_time'    => ['nullable'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['required', 'date'],
            'description' => ['nullable'],
            'color'       => ['required', Rule::in(Calendar::COLORS)],
            'created_by'  => ['nullable'],
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
            'scope.in' => "API scope value is incorrect.",
            'color.in' => "API 'color' value chosen is unavailble. Please select the correct choices.",
            'all_day.in' => "API 'all_day' value is either null, 0 or 1.",
        ];
    }
}
