<?php

namespace App\Console\Commands;

use App\Actions\Seed\BaseFaqSeeder;
use App\Actions\Seed\BaseImageSeeder;
use App\Actions\Seed\BaseSettingsSeeder;
use App\Actions\Seed\BaseTenantSeeder;
use App\Models\CustomPage;
use App\Models\Layout;
use App\Models\LayoutDefinition;
use App\Models\Navigation;
use App\Models\Tenant;
use App\Models\User;
use Database\Seeders\ActivityLast30DaysSeeder;
use Database\Seeders\AllActivityLastThirtyDays;
use Database\Seeders\ChartDatasourceSeeder;
use Database\Seeders\EmailChartDataSeeder;
use Database\Seeders\MyActivityLastThirtyDays;
use Database\Seeders\UserMessageStatsSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedBaseProject extends Command {
    protected $signature = 'db:seed-base-project {username : default ILINX admin username} {email : email admin user} {phone : admin phone}';

    protected $description = 'Seed the initial ILINX Engage system';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $name  = $this->argument('username');
        $email = $this->argument('email');
        $phone = $this->argument('phone');

        BaseTenantSeeder::execute();
        $user = $this->createAdminUser($name, $email, $phone);

        // Set the primary contact to the new admin user
        Tenant::where('tenant_id', 'host')->update(['primary_contact' => $user->id]);

        $this->createDefaultLayout($user->id, 1);
        $this->createDefaultLayout($user->id, 2);

        BaseFaqSeeder::execute($user);
        BaseSettingsSeeder::execute($user);
        BaseImageSeeder::execute($user->tenant_id);

        Artisan::call('db:seed', ['--class' => UserMessageStatsSeeder::class]);
        Artisan::call('db:seed', ['--class' => ActivityLast30DaysSeeder::class]);
        Artisan::call('db:seed', ['--class' => ChartDatasourceSeeder::class]);
        Artisan::call('db:seed', ['--class' => EmailChartDataSeeder::class]);
        Artisan::call('db:seed', ['--class' => AllActivityLastThirtyDays::class]);
        Artisan::call('db:seed', ['--class' => MyActivityLastThirtyDays::class]);

        $this->info('Base seeders executed successfully');

    }

    // ///////////////////////////////////////////////////////////////////////////////////////
    private function createDefaultLayout($userid, $user_group) {
        $default_title = "Default";
        $default_descr = "Default layout for employees";

        if ($user_group == 2) {
            $default_title = "Partner Home";
            $default_descr = "Default layout for tenants";
        }

        $layoutDefinition = LayoutDefinition::create([
            'title'           => $default_title,
            'description'     => $default_descr,
            'user_group'      => $user_group,
            'security_groups' => null,
        ]);

        Layout::create([
            'title'                => 'Notifications',
            'single_item'          => 'Notification',
            'plural_item'          => 'Notifications',
            'width'                => '50%',
            'max_item'             => '5',
            'content_type'         => 'Notifications',
            'data_source'          => 'Standard Notifications',
            'order_no'             => '0',
            'created_by'           => $userid,
            'position'             => 'middle',
            'layout_definition_id' => $layoutDefinition->id,
            'eform_url'            => 'null',
            'custom_url'           => null,
        ]);

        Layout::create([
            'title'                => 'Calendar',
            'single_item'          => 'Event',
            'plural_item'          => 'Events',
            'width'                => '50%',
            'max_item'             => '5',
            'content_type'         => 'Calendar',
            'data_source'          => 'Standard Calendar',
            'order_no'             => '1',
            'created_by'           => $userid,
            'position'             => 'middle',
            'layout_definition_id' => $layoutDefinition->id,
            'eform_url'            => 'null',
            'custom_url'           => null,
        ]);

        if ($user_group == 1) {
            $customPage = CustomPage::create([
                'title'  => 'Welcome!',
                'detail' => view('seed.custom-page-welcome')->render(),
            ]);
        } else {
            $customPage = CustomPage::create([
                'title'  => 'Welcome partner!',
                'detail' => view('seed.custom-page-welcome-external')->render(),
            ]);
        }

        Layout::create([
            'title'                => 'Welcome',
            'single_item'          => 'Note',
            'plural_item'          => 'Notes',
            'width'                => '100%',
            'max_item'             => '5',
            'content_type'         => 'Custom Page',
            'data_source'          => $customPage->id,
            'order_no'             => '1',
            'created_by'           => $userid,
            'position'             => 'top',
            'layout_definition_id' => $layoutDefinition->id,
            'eform_url'            => 'null',
            'custom_url'           => null,
        ]);

        if ($user_group == 1) {
            Layout::create([
                'title'                => 'System Activity',
                'single_item'          => 'Event',
                'plural_item'          => 'Events',
                'width'                => '100%',
                'max_item'             => '31',
                'content_type'         => 'Line Chart',
                'data_source'          => 'Last 30 days activities',
                'order_no'             => '1',
                'created_by'           => $userid,
                'position'             => 'bottom',
                'layout_definition_id' => $layoutDefinition->id,
                'eform_url'            => 'null',
                'custom_url'           => null,
                'adv_config'           => '',
            ]);
        }

        Navigation::create([
            'order_no'             => '0',
            'title'                => 'Documents',
            'content_type'         => 'All content views',
            'data_source'          => 'List all Content views',
            'show_top_menu'        => '1',
            'show_nav_menu'        => '1',
            'icon'                 => 'far fa-folder-open',
            'layout_definition_id' => $layoutDefinition->id,
            'eform_url'            => 'null',
        ]);

        Navigation::create([
            'order_no'             => '1',
            'title'                => 'Workflows',
            'content_type'         => 'All workflow views',
            'data_source'          => 'List all Workflow views',
            'show_top_menu'        => '1',
            'show_nav_menu'        => '1',
            'icon'                 => 'fas fa-box-open',
            'layout_definition_id' => $layoutDefinition->id,
            'eform_url'            => 'null',
        ]);

        Navigation::create([
            'order_no'             => '2',
            'title'                => 'Forms',
            'content_type'         => 'Forms',
            'data_source'          => 'Available Forms',
            'show_top_menu'        => '1',
            'show_nav_menu'        => '1',
            'icon'                 => '',
            'layout_definition_id' => $layoutDefinition->id,
            'eform_url'            => 'null',
        ]);

        Navigation::create([
            'order_no'             => '3',
            'title'                => 'Calendar',
            'content_type'         => 'Calendar',
            'data_source'          => 'Standard Calendar',
            'show_top_menu'        => '1',
            'show_nav_menu'        => '1',
            'icon'                 => 'far fa-calendar-times',
            'layout_definition_id' => $layoutDefinition->id,
            'eform_url'            => 'null',
        ]);

        Navigation::create([
            'order_no'             => '5',
            'title'                => 'Help',
            'content_type'         => 'Help Page',
            'data_source'          => 'Help Center Content',
            'show_top_menu'        => '1',
            'show_nav_menu'        => '1',
            'icon'                 => 'far fa-question-circle',
            'layout_definition_id' => $layoutDefinition->id,
            'eform_url'            => 'null',
        ]);
    }

    private function createAdminUser($username, $email, $phone): User {
        $user = User::where('username', config('users.username'))->first();

        if (!empty($user)) {
            if ($user->account_type !== 2 || ($user->account_status !== 1 || $user->account_status !== 'active')) {
                $user->delete();
                $user = null;
            }
        }

        if (empty($user)) {
            $user = User::factory()->create([
                'tenant_id'              => 'host',
                'username'               => $username,
                'name'                   => 'Default Administrator',
                'account_type'           => User::INTERNAL_TENANT_ADMIN,
                'account_status'         => 'active',
                'account_status_message' => 'Administrative account active',
                'email'                  => $email,
                'avatar'                 => 'avatars/default.png',
                'active_status'          => '0',
                'created_by'             => '0',
                'lang'                   => 'en',
                'remember_token'         => 'null',
                'chat_user'              => '1',
                'phone'                  => $phone,
                'dark_mode'              => '0',
                'messenger_color'        => '#2180f3',
                'communication_channel'  => 'phone',
                'texting_number'         => $phone,
            ]);
        }

        return $user;
    }

}
