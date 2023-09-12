<?php

namespace Database\Seeders;

use App\Models\ChartDatasource;
use Illuminate\Database\Seeder;

class ChartDatasourceSeeder extends Seeder
{
    private array $procedures = [
        'user_message_stats' => 'Chat Stats',
    ];

    public function run()
    {
        $databaseName = env('DB_DATABASE');
        $dataSources  = \DB::select("SELECT * FROM $databaseName.INFORMATION_SCHEMA.ROUTINES WHERE ROUTINE_TYPE = 'PROCEDURE'");

        foreach ($dataSources as $source) {
            if (array_key_exists($source->ROUTINE_NAME, $this->procedures)) {
                ChartDatasource::create([
                    'datasource_name' => $this->procedures[$source->ROUTINE_NAME],
                    'sp_name'         => $source->ROUTINE_NAME,
                ]);
            }
        }
    }
}
