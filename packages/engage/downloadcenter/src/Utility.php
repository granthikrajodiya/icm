<?php

namespace Engage\Downloadcenter;

use App\Http\Controllers\UserController;

class Utility
{
    /**
     * Necessary function to load data sources
     *
     * @return array
     */
    public static function getDataSource() :array
    {
        return [
            'Standard downloads',
        ];
    }
}
