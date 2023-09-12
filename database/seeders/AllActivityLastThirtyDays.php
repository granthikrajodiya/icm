<?php

namespace Database\Seeders;

use App\Models\ChartDatasource;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllActivityLastThirtyDays extends Seeder
{
    public function run()
    {
        $procedure = 'CREATE OR ALTER PROCEDURE [dbo].[all_activity_last_30_days] (@user_id int, @tenant_id VARCHAR(100)) AS
        BEGIN
            /** NOTE: The input parameters are defined but ignored for this procedure **/
            select CONVERT(varchar,dateadd(DAY,0, datediff(day,0, [date_time])),101) as "Date", count(*) as "Activities" from [activities]
            WHERE DATEDIFF(day,[date_time],GETDATE()) < 31
            group by dateadd(DAY,0, datediff(day,0, [date_time]))
            order by "Date"
        END';

        DB::unprepared($procedure);

        ChartDatasource::updateOrCreate(
            ['sp_name' => "all_activity_last_30_days"],
            [
                'datasource_name' => "All User Activities Last 30 Days",
                'sp_name'         => "all_activity_last_30_days",
            ]
        );
    }
}
