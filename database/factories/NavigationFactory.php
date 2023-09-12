<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class NavigationFactory extends Factory
{
    public function definition()
    {
        return [
            'order_no'      => $this->faker->numberBetween(0, 10),
            'title'         => $this->faker->word(),
            'content_type'  => $this->faker->word(),
            'data_source'   => $this->faker->word(),
            'show_top_menu' => $this->faker->boolean(50),
            'show_nav_menu' => $this->faker->boolean(50),
            'icon'          => Arr::random(['fab fa-accessible-icon', 'fab fa-accusoft']),
            'eform_url'     => $this->faker->url(),
        ];
    }
}
