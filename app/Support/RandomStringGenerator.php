<?php

namespace App\Support;

use Illuminate\Support\Str;

class RandomStringGenerator
{
    public function generate(int $length = 6): string
    {
        return Str::random($length);
    }
}