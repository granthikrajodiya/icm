<?php

namespace Database\Factories;

use App\Models\LayoutDefinition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class LayoutDefinitionFactory extends Factory
{
    public function definition()
    {
        return [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->text,
            'user_group'  => Arr::random(LayoutDefinition::USER_GROUPS)
        ];
    }
}
