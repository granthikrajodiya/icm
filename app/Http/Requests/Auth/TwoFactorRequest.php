<?php

namespace App\Http\Requests\Auth;

use App\Models\TwoFactorAuthenticationCode;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TwoFactorRequest extends FormRequest
{
    public function rules(): array
    {
        /** @var User */
        $user = Auth::user();

        return [
            'code' => [
                'required',
                'string',
                'size:6',
                Rule::exists(TwoFactorAuthenticationCode::class, 'code')->where(
                    fn (Builder $query): Builder => $query->where('user_id', $user->id)
                        ->where('created_at', '>', Carbon::now()->subMinutes(15))
                ),
            ],
        ];
    }
}
