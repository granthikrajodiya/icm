<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChartDatasourceFactory extends Factory
{
    public function definition()
    {
        return [
            'datasource_name' => strtoupper($this->faker->unique()->word),
            'sp_name'         => $this->faker->unique()->word
        ];
    }
}
