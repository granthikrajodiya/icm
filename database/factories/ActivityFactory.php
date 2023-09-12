<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ActivityFactory extends Factory
{
    public function definition()
    {
        return [
            'type'      => Arr::random(Activity::TYPES),
            'date_time' => $this->faker->dateTimeBetween('-10 days', now()),
            'text'      => $this->faker->text
        ];
    }
}
