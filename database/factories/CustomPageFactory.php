<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomPageFactory extends Factory
{
    public function definition()
    {
        return [
            'title'  => $this->faker->unique()->word,
            'detail' => $this->faker->randomHtml(1, 1),
        ];
    }
}
