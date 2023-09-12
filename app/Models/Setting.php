<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    protected $fillable = [
        'name',
        'value',
        'created_by',
    ];

    const VALUES_FOOTER_TEXT              = 0;
    const VALUES_FOOTER_LINK_1            = 1;
    const VALUES_FOOTER_VALUE_1           = 2;
    const VALUES_FOOTER_LINK_2            = 3;
    const VALUES_FOOTER_VALUE_2           = 4;
    const VALUES_FOOTER_LINK_3            = 5;
    const VALUES_FOOTER_VALUE_3           = 6;
    const VALUES_MAX_DOCS_HOMEPAGE_CARDS  = 7;
    const VALUES_MAX_TASKS_HOMEPAGE_CARDS = 8;
    const VALUES_WELCOME_MESSAGE          = 9;
    const VALUES_DOCUMENT_MENU            = 10;
    const VALUES_TASK_MENU                = 11;
    const VALUES_ACTIVITIES_MENU          = 12;
    const VALUES_HELP_MENU                = 13;
    const VALUES_SALUTATION               = 14;
    const VALUES_SINGLE_TASK_WORK_ITEM    = 15;
    const VALUES_PLURAL_TASK_WORK_ITEM    = 16;
    const VALUES_HELP_CENTER_TEXT         = 17;
    const VALUES_FOLDER_MENU              = 18;
    const VALUES_TERMS_CONDITIONS         = 19;
    const VALUES_WELCOME_MESSAGE_EXT      = 20;
    const VALUES_WELCOME_MESSAGE_INT      = 21;
    const VALUES_SIDEBAR_EDITOR           = 22;
    const VALUES_SIDEBAR_EDITOR_BG        = 23;
    const VALUES_SIDEBAR_EDITOR_STYLE     = 24;
    const VALUES_BG_GRADIENT              = 25;
    const VALUES_NO_PASSWORD_RESET_MESSAGE = 26;

    const VALUES = [
        self::VALUES_FOOTER_TEXT => [
            'name'  => 'footer_text',
            'value' => '© 2023 ImageSource',

        ],
        self::VALUES_FOOTER_LINK_1 => [
            'name'  => 'footer_link_1',
            'value' => 'Support',

        ],
        self::VALUES_FOOTER_VALUE_1 => [
            'name'  => 'footer_value_1',
            'value' => '#',

        ],
        self::VALUES_FOOTER_LINK_2 => [
            'name'  => 'footer_link_2',
            'value' => 'Terms',

        ],
        self::VALUES_FOOTER_VALUE_2 => [
            'name'  => 'footer_value_2',
            'value' => '#',

        ],
        self::VALUES_FOOTER_LINK_3 => [
            'name'  => 'footer_link_3',
            'value' => 'Privacy',

        ],
        self::VALUES_FOOTER_VALUE_3 => [
            'name'  => 'footer_value_3',
            'value' => 'https://ilinx.com/privacypolicy/',

        ],
        self::VALUES_MAX_DOCS_HOMEPAGE_CARDS => [
            'name'  => 'max_docs_homepage_cards',
            'value' => '5',

        ],
        self::VALUES_MAX_TASKS_HOMEPAGE_CARDS => [
            'name'  => 'max_tasks_homepage_cards',
            'value' => '5',

        ],
        self::VALUES_WELCOME_MESSAGE => [
            'name'  => 'welcome_message',
            'value' => 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',

        ],
        self::VALUES_DOCUMENT_MENU => [
            'name'  => 'document_menu',
            'value' => 'Documents',

        ],
        self::VALUES_TASK_MENU => [
            'name'  => 'task_menu',
            'value' => 'Tasks',

        ],
        self::VALUES_ACTIVITIES_MENU => [
            'name'  => 'activities_menu',
            'value' => 'Activities',

        ],
        self::VALUES_HELP_MENU => [
            'name'  => 'help_menu',
            'value' => 'Help Center',

        ],
        self::VALUES_SALUTATION => [
            'name'  => 'salutation',
            'value' => '[Good morning|afternoon|evening]',

        ],
        self::VALUES_SINGLE_TASK_WORK_ITEM => [
            'name'  => 'single_task_work_item',
            'value' => 'Task',

        ],
        self::VALUES_PLURAL_TASK_WORK_ITEM => [
            'name'  => 'plural_task_work_item',
            'value' => 'Tasks',

        ],
        self::VALUES_HELP_CENTER_TEXT => [
            'name'  => 'help_center_text',
            'value' => '<p><span style="\&quot;margin:" 0px;="" padding:="" font-family:="" &quot;open="" sans&quot;,="" arial,="" sans-serif;="" font-size:="" 14px;="" text-align:="" justify;\"="">Lorem Ipsum</span><span style="\&quot;font-family:" &quot;open="" sans&quot;,="" arial,="" sans-serif;="" font-size:="" 14px;="" text-align:="" justify;\"="">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><span style="\&quot;font-family:" &quot;open="" sans&quot;,="" arial,="" sans-serif;="" font-size:="" 14px;="" text-align:="" justify;\"="">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span></p>',

        ],
        self::VALUES_FOLDER_MENU => [
            'name'  => 'folder_menu',
            'value' => 'Files',

        ],
        self::VALUES_TERMS_CONDITIONS => [
            'name'  => 'terms_conditions',
            'value' => '#',

        ],
        self::VALUES_WELCOME_MESSAGE_EXT => [
            'name'  => 'welcome_message_ext',
            'value' => '<p>Hello World Test Demo External</p>',

        ],
        self::VALUES_WELCOME_MESSAGE_INT => [
            'name'  => 'welcome_message_int',
            'value' => '<p>Hello World Test Demo Internal</p>',

        ],
        self::VALUES_SIDEBAR_EDITOR => [
            'name'  => 'sidebar_editor',
            'value' => '<p style="line-height: 1;"><br></p><h6 style="text-align: center; line-height: 1;"></h6><h6><div style="text-align: center;"><b style="font-family: inherit; font-size: 1rem; color: rgb(0, 0, 0);">FREE RESOURCE</b></div><b><div style="text-align: center;"><b style="font-family: inherit; font-size: 1rem; color: rgb(0, 0, 0);">LIBRARY</b></div></b></h6><p style="text-align: center; line-height: 1;"><span style="font-size: 12px;">Start getting a breakthrough with your<br></span><span style="font-size: 12px;">blog today.</span></p><p style="text-align: center; line-height: 1;"><span style="font-size: 12px;"><br></span></p><p style="text-align: center; line-height: 1;"><a href="http://www.google.com" target="_blank" style="padding: 10px; color: rgb(255, 255, 255); background-color: rgb(231, 99, 99);">GET ACCESS</a><br></p>',

        ],
        self::VALUES_SIDEBAR_EDITOR_BG => [
            'name'  => 'sidebar_editor_bg',
            'value' => '#df1111',

        ],
        self::VALUES_SIDEBAR_EDITOR_STYLE => [
            'name'  => 'sidebar_editor_style',
            'value' => 'bg_gradient',

        ],
        self::VALUES_BG_GRADIENT => [
            'name'  => 'bg_gradient',
            'value' => 'bg-gradient-warning',

        ],
        self::VALUES_NO_PASSWORD_RESET_MESSAGE => [
            'name'  => 'no_password_reset_message',
            'value' => 'We have received a request to reset your password however, your account password is not managed by ILINX and cannot be reset through the ILINX system. Please contact your company’s system administrator for help with resetting your password.',

        ],
    ];
}
