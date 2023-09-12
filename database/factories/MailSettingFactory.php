<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MailSettingFactory extends Factory
{
    public function definition()
    {
        return [
            'mail_driver'       => 'smtp',
            'mail_host'         => 'smtp.mailtrap.io',
            'mail_port'         => 2525,
            'mail_username'     => $this->faker->userName,
            'mail_password'     => $this->faker->password,
            'mail_encryption'   => 'tls',
            'mail_from_address' => $this->faker->email,
            'mail_from_name'    => $this->faker->name,
        ];
    }
}
