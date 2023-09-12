<?php

namespace Database\Seeders;

use App\Models\ChartDatasource;
use DB;
use Illuminate\Database\Seeder;

class ActivityLast30DaysSeeder extends Seeder
{
    public function run()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS activity_last_30_days;");

        DB::unprepared("CREATE PROCEDURE [dbo].[activity_last_30_days](@user_id int, @tenant_id VARCHAR(100))
        AS
            BEGIN
            SELECT CONVERT(varchar,dateadd(DAY,0, datediff(day,0, [date_time])),101) as 'Date', count(*) as 'Activities'
            FROM [activities]
            WHERE DATEDIFF(day,[date_time],GETDATE()) < 31
            group by dateadd(DAY,0, datediff(day,0, [date_time]))
            order by 'Date'
        END");

        ChartDatasource::updateOrCreate(
            ['sp_name' => "activity_last_30_days"],
            [
                'datasource_name' => "Last 30 days activities",
                'sp_name'         => "activity_last_30_days",
            ]
        );
    }
}
