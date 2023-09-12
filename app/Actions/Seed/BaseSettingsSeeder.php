<?php

namespace App\Actions\Seed;

use App\Models\Setting;
use App\Models\User;

class BaseSettingsSeeder
{
    public static function execute(User $user)
    {
        $createdBy     = $user->id;
        $settingsValue = self::getSettingsValues();

        foreach ($settingsValue as $value) {
            $value['created_by'] = $createdBy;

            $setting = Setting::where('name', $value['name'])->where('created_by', $value['created_by'])->first();
            if (empty($setting)) {
                Setting::create($value);
            }
        }
    }

    private static function getSettingsValues(): array
    {
        return [
            [
                'name'  => 'footer_text',
                'value' => '© 2023 ImageSource',

            ],
            [
                'name'  => 'footer_link_1',
                'value' => 'Support',

            ],
            [
                'name'  => 'footer_value_1',
                'value' => 'https://imagesourceinc.com/imagesource-support/',
            ],
            [
                'name'  => 'footer_link_2',
                'value' => 'Terms',
            ],
            [
                'name'  => 'footer_value_2',
                'value' => 'https://imagesourceinc.com/imagesource-support/',
            ],
            [
                'name'  => 'footer_link_3',
                'value' => 'Privacy',
            ],
            [
                'name'  => 'footer_value_3',
                'value' => 'https://imagesourceinc.com/privacy-policy-2/',
            ],
            [
                'name'  => 'max_docs_homepage_cards',
                'value' => '5',
            ],
            [
                'name'  => 'max_tasks_homepage_cards',
                'value' => '3',
            ],
            [
                'name'  => 'show_calendar',
                'value' => 'on',
            ],
            [
                'name'  => 'document_menu',
                'value' => 'Documents',
            ],
            [
                'name'  => 'task_menu',
                'value' => 'Tasks',
            ],
            [
                'name'  => 'activities_menu',
                'value' => 'Activities',
            ],
            [
                'name'  => 'help_menu',
                'value' => 'Help',
            ],
            [
                'name'  => 'salutation',
                'value' => '[Good morning|afternoon|evening]',
            ],
            [
                'name'  => 'single_task_work_item',
                'value' => 'Task',
            ],
            [
                'name'  => 'plural_task_work_item',
                'value' => 'Tasks',
            ],
            [
                'name'  => 'welcome_title',
                'value' => 'ILINX Engage',
            ],
            [
                'name'  => 'help_center_text',
                'value' => '
                    <h4><span style="font-family: Nunito; color: rgb(57, 132, 198); font-size: 24px;" 0px;="" padding:="" font-family:="" &quot;open="" sans&quot;,="" arial,="" sans-serif;="" font-size:="" 14px;="" text-align:="" justify;\"="">My Help Page</span></h4><p><span style="\&quot;margin:" 0px;="" padding:="" font-family:="" &quot;open="" sans&quot;,="" arial,="" sans-serif;="" font-size:="" 14px;="" text-align:="" justify;\"="">If you have any questions please contact our office at <span style="font-weight: bold;">(360)943-9273</span>. Or you can stop by and visit us in person at 3003 Sunset Way SE, Olympia WA 98501.</span></p><p><b style="font-size: 1rem;"><i><span style="font-family: Nunito; font-size: 18px;">Thank you for using ILINX Engage!</span></i></b><br></p><p><span style="\&quot;font-family:" &quot;open="" sans&quot;,="" arial,="" sans-serif;="" font-size:="" 14px;="" text-align:="" justify;\"=""><br></span></p>
                ',
            ],
            [
                'name'  => 'terms_conditions',
                'value' => 'https://imagesourceinc.com/privacy-policy-2/',
            ],
            [
                'name'  => 'show_folder',
                'value' => 'on',
            ],
            [
                'name'  => 'show_chat',
                'value' => 'off',
            ],
            [
                'name'  => 'folder_menu',
                'value' => 'Files',
            ],
            [
                'name'  => 'sidebar_editor',
                'value' => '
                    <p style="text-align: center; line-height: 1.8;background-color:transparent;"></p><p style="text-align: center; line-height: 1.8;background-color:transparent;"></p><p style="text-align: center; line-height: 1; background-color: transparent;"><b style="background-color: transparent; font-size: 1rem;"><span style="font-family: &quot;Arial Black&quot;; font-size: 24px; color: rgb(255, 255, 255);">Latest Company News</span></b><br></p><p style="text-align: center; line-height: 1;"><font color="#ffffff" face="Nunito">Add your most recent company news here to grab the attention of your users!</font></p><p style="text-align: center; line-height: 1.2;"><span style="font-size: 1rem; color: rgb(255, 255, 255);"><span style="font-family: Lato, sans-serif; line-height: inherit; border: 0px; outline: 0px; -webkit-font-smoothing: antialiased; overflow-wrap: break-word;">&nbsp;</span></span><a href="http://blog.imagesourceinc.com/blog" target="_blank">Read more...</a></p><p style="text-align: center; line-height: 1.2;"><br></p>
                ',
            ],

            [
                'name'  => 'sidebar_editor_bg',
                'value' => '#f6f6f6',
            ],
            [
                'name'  => 'sidebar_editor_style',
                'value' => 'bg_gradient',
            ],
            [
                'name'  => 'bg_gradient',
                'value' => 'bg-gradient-warning',
            ],
            [
                'name'  => 'favicon',
                'value' => 'logo/favicon.ico',
            ],
        ];
    }
}
