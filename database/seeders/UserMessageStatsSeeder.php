<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserMessageStatsSeeder extends Seeder
{
    public function run()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS user_message_stats;");

        DB::unprepared("CREATE PROCEDURE [dbo].[user_message_stats](@user_id int, @tenant_id VARCHAR(100)) 
        AS 
            BEGIN 
            SELECT name AS 'User', count(*) AS 'Message Sent' 
            FROM ch_messages, users 
            WHERE ch_messages.from_id = @user_id 
            GROUP BY NAME; 
        END");
    }
}
