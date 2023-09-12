<?php

namespace Database\Factories;

use App\Models\Calendar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class CalendarFactory extends Factory
{
    protected $model = Calendar::class;

    public function definition()
    {
        $start = Carbon::now()->add(rand(1, 3) . ' days')->addHour(rand(1, 3))->addMinute(rand(1, 3));
        $end   = Carbon::now()->add(rand(4, 6) . ' days')->addHour(rand(1, 3))->addMinute(rand(1, 3));

        return [
            'scope'       => Arr::random(Calendar::SCOPE_TYPES),
            'name'        => $this->faker->word,
            'start_time'  => $start->format('h:i:s'),
            'end_time'    => $end->format('h:i:s'),
            'start_date'  => $start,
            'end_date'    => $end,
            'description' => $this->faker->text(),
            'color'       => Arr::random(Calendar::COLORS),
        ];
    }
}
