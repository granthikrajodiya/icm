<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition()
    {
        return [
            'tenant_id'     => $this->faker->unique()->word,
            'company_name'  => $this->faker->company(),
            'company_phone' => $this->faker->phoneNumber(),

            'address' => $this->faker->streetName(),
            'city'    => $this->faker->city(),
            'state'   => $this->faker->state(),
            'zip'     => $this->faker->postcode(),

            'account_status'  => $this->faker->numberBetween(0, 1),
            'message'         => $this->faker->text(),
            'primary_contact' => (int)$this->faker->postcode(),
            'data'            => null,

            'logo'        => $this->faker->text(),
            'banner_type' => $this->faker->text(),
            'banner'      => $this->faker->text(),

            'header_text'   => $this->faker->text(),
            'default_theme' => $this->faker->name(),
            'date_format'   => null,
            'day_start'     => null,

            'show_activities' => $this->faker->numberBetween(0, 1)
        ];
    }

    public function active(): static
    {
        return $this->state(fn () => ['account_status' => 1]);
    }

    public function setDefaultTheme($defaultTheme): static
    {
        return $this->state(fn () => ['default_theme' => $defaultTheme]);
    }
}
