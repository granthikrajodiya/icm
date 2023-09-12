<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    public function definition()
    {
        return [
            'title'  => $this->faker->text(20),
            'detail' => $this->faker->randomHtml(1, 1),
        ];
    }

    public function createdBy(int $id)
    {
        return $this->state(fn () => ['created_by' => $id]);
    }
}
