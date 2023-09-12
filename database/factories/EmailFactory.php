<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    public function definition()
    {
        return [
            'batch_id'    => $this->faker->uuid(),
            'to'          => $this->faker->unique()->safeEmail(),
            'subject'     => $this->faker->text(20),
            'description' => $this->faker->randomHtml(1, 1),
        ];
    }
}
