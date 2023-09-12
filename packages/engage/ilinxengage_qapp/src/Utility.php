<?php

namespace Engage\ilinxengage_qapp;

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
            'Data Source 1',
            'Data Source 2',
        ];
    }
}
