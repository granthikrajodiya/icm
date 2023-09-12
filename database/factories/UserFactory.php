<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name'                   => $this->faker->name(),
            'username'               => $this->faker->userName(),
            'email'                  => $this->faker->unique()->safeEmail(),
            'password'               => Hash::make("secret"),
            'avatar'                 => "",
            'lang'                   => $this->faker->languageCode(),
            'account_type'           => $this->faker->numberBetween(0, 4),

            'account_status'         => Arr::random(['inactive', 'active']),
            'account_status_message' => $this->faker->sentence(),

            'chat_user'              => $this->faker->numberBetween(0, 4),
            'last_login_at'          => $this->faker->dateTime(),
            'password_change_at'     => $this->faker->dateTime(),
            'phone'                  => $this->faker->phoneNumber(),
            'notifications_read'     => $this->faker->dateTime(),
            'communication_channel'  => Arr::random(['slack', 'telegram', 'instagram']),
            'texting_number'         => $this->faker->word(),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function active()
    {
        return $this->state(fn() => ['account_status' => 'active']);
    }

    public function customerClient()
    {
        return $this->state(fn() => ['account_type' => User::EXTERNAL_TENANT_USER]);
    }

    public function admin()
    {
        return $this->state(fn() => ['account_type' => User::INTERNAL_TENANT_ADMIN]);
    }
}
