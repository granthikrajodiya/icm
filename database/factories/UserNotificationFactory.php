<?php

namespace Database\Factories;

use App\Models\UserNotification;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class UserNotificationFactory extends Factory
{
    protected $model = UserNotification::class;

    public function definition()
    {
        return [
            'scope'      => Arr::random(['user', 'tenant', 'system']),
            'type'       => Arr::random(['random1', 'random2', 'random3']),
            'text'       => $this->faker->sentence(),
            'link_title' => $this->faker->word(),
            'link_color' => Arr::random(['red', 'green', 'blue']),
            'link_url'   => $this->faker->url(),
            'link_type'  => Arr::random(['type1', 'type2', 'type3']),
        ];
    }
}