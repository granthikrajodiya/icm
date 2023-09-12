<?php

namespace Database\Factories;

use App\Models\RestIntegration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class RestIntegrationFactory extends Factory
{
    protected $model = RestIntegration::class;

    public function definition()
    {
        return [
            'parent_id'         => Arr::random(RestIntegration::PARENTS_INTEGRATION),
            'name'              => $this->faker->name,
            'rest_endpoint_url' => $this->faker->url(),
            'http_method'       => Arr::random(['get', 'post', 'put', 'delete']),

            'http_authentication' => Arr::random(RestIntegration::HTTP_AUTH),
            'http_username'       => $this->faker->userName(),
            'http_password'       => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'custom_http_headers' => Arr::random(RestIntegration::CUSTOM_HTTP_HEADER),

            'http_headers' => "{\"Content-Type\": \"application/json\"}",

            'data_format' => Arr::random(RestIntegration::DATA_FORMATS),

            'data_parameter' => "", // JSON
            'result_list'    => "[]", // ARRAY

            'integration_type' => Arr::random(RestIntegration::INTEGRATION_TYPES),
            'details_type'     => Arr::random(RestIntegration::DETAIL_TYPES),

            'basic_details' => "[]", // ARRAY
        ];
    }
}
