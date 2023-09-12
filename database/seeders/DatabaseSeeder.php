<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TenantSeeder::class,
            UserSeeder::class,
            SettingsSeeder::class,
            CalendarSeeder::class,
            ActivitySeeder::class,
            CallSeeder::class,
            CaseNoteSeeder::class,
            CustomPageSeeder::class,
            DiscussionSeeder::class,
            EmailSeeder::class,
            FaqSeeder::class,
            LayoutDefinitionSeeder::class,
            LayoutSeeder::class,
            NavigationSeeder::class,
            NoteSeeder::class,
            RestIntegrationSeeder::class,
            UserNotificationSeeder::class,
            UserMessageStatsSeeder::class,
            ChartDatasourceSeeder::class,
            EmailChartDataSeeder::class,
        ]);
    }
}
