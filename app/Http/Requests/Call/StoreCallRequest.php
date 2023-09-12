<?php

namespace App\Http\Requests\Call;

use App\Models\Call;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCallRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "subject"     => ["required", "string", "max:128"],
            "call_type"   => ["required", Rule::in(Call::CALL_TYPES)],
            "batch_id"    => ["nullable"],
            "duration"    => ["required"],
            "description" => ["nullable", "string", "max: 255"],
            "call_date"   => ["required", "date", "date_format:Y-m-d"],
        ];
    }
}
