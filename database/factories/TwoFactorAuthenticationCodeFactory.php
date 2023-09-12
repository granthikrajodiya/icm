<?php

namespace Database\Factories;

use App\Models\TwoFactorAuthenticationCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class TwoFactorAuthenticationCodeFactory extends Factory
{
    protected $model = TwoFactorAuthenticationCode::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->numerify('######'),
        ];
    }
}
