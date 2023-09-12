<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionFactory extends Factory
{
    public function definition()
    {
        return [
            'batch_id' => $this->faker->uuid(),
            'comment'  => $this->faker->text,
        ];
    }
}
