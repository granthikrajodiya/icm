<?php

use App\Models\Setting;
use App\Models\Tenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $value = [
            'name'  => 'host_password_reset_message',
            'value' => '  <p class="text-muted"> In order to reset your account password please contact our offices by calling (360)555-1212 between the hours of 8:00AM and 5:00PM Pacific.
                </p>
                <p class="text-muted">We apologize for any inconvenience.</p>
                <p class="text-muted">Thank you.</p>',
        ];

        // checking for fresh install
        $tenant = Tenant::where('tenant_id', 'host')->first();
        if (empty($tenant)){
            return false;
        }

        // checking for those system alredy installed
        $setting = Setting::where([
            ['name', $value['name']],
            ['created_by', $tenant->id]
        ])->first();

        if ($setting == null) {
            $value['created_by'] = $tenant->id;
            Setting::create($value);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $value = [
            'name'  => 'host_password_reset_message'
        ];

        $tenant = Tenant::where('tenant_id', 'host')->first();
        if (empty($tenant)){
            return false;
        }

        $setting = Setting::where([
            ['name', $value['name']],
            ['created_by', $tenant->id]
        ])->first();

        if($setting) {
            $setting->delete();
        }
    }
};
