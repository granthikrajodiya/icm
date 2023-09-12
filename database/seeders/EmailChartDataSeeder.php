<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class EmailChartDataSeeder extends Seeder
{
    public function run()
    {
        $procedure = 'CREATE OR ALTER PROCEDURE [dbo].[ird_email_chart_data] @batch_id nvarchar(100) AS
        BEGIN
            select count(*) as "Count", email_status as "Email Status"
            from ird_solicitation_emails
            where batch_id=@batch_id
            group by email_status
        END';

        DB::unprepared($procedure);
    }
}
