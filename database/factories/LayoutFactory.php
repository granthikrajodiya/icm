<?php

namespace Database\Factories;

use App\Models\Layout;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class LayoutFactory extends Factory {
    public function definition() {
        return [
            'title'                => $this->faker->word(),
            'single_item'          => $this->faker->word(),
            'plural_item'          => $this->faker->word(),
            'position'             => Arr::random(Layout::$position),
            'width'                => Arr::random(Layout::$width),
            'max_item'             => $this->faker->numberBetween(3, 80),
            'content_type'         => Arr::random(Layout::$homePageCardContentType),
            'data_source'          => $this->faker->word(),
            'order_no'             => $this->faker->numberBetween(1, 20),
            'layout_definition_id' => Arr::random(Layout::LAYOUT_DEFINITIONS),
            'eform_url'            => $this->faker->url(),
            'adv_config'           => $this->faker->word(),
        ];
    }
}
