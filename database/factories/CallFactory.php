<?php

namespace Database\Factories;

use App\Models\Call;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class CallFactory extends Factory
{
    public function definition()
    {
        $start = Carbon::now()->add(rand(1, 3) . ' days')->addHour(rand(1, 3))->addMinute(rand(1, 3));

        return [
            'batch_id'    => $this->faker->uuid(),
            'subject'     => $this->faker->word,
            'call_type'   => Arr::random(Call::CALL_TYPES),
            'duration'    => $start->format('h:i'),
            'description' => $this->faker->text,
            'call_date'   => $start,
        ];
    }
}
