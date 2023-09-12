<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    public function definition()
    {
        return [
            'batch_id' => $this->faker->uuid(),
            'notes'    => $this->faker->text
        ];
    }
}
