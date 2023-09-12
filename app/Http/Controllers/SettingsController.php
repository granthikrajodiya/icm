<?php

namespace App\Http\Controllers;

use App\Facades\ILINX;
use App\Mail\EmailTest;
use App\Models\CustomPage;
use App\Models\Faq;
use App\Models\LayoutDefinition;
use App\Models\MailSetting;
use App\Models\ModulePermissionAssignment;
use App\Models\ModulePermissionDef;
use App\Models\RestIntegration;
use App\Models\Setting;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Newsfeeds;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * @SuppressWarnings(PHPMD)
 */
class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // if (user()->account_type == User::PUBLIC_CLIENT) {
            //     return redirect()->back()->with('error', __('Permission Denied.'));
            // }

            return $next($request);
        });

        $this->middleware('mail.config')->only('testEmailSend');
    }

    public function index() {

        $usrData         = Session::get('userInfo');
        $userGroups      = $usrData->UserGroups ?? [];
        $permsAssignment = ModulePermissionAssignment::all();

        $userPerms = ModulePermissionAssignment::userPermissions();

        if (user()->account_type == User::INTERNAL_TENANT_ADMIN ||
            user()->account_type == User::EXTERNAL_TENANT_ADMIN ||
            in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms) ||
            in_array('FAQ_ALL_CONTENT', $userPerms) ||
            in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms)
        ) {
            // Unset Navigation Title
            if (Session::has('navigation_title')) {
                Session::forget('navigation_title');
            }

            // For Theme
            $themes = [
                'ilinx'       => 'ILINX',
                'purple'      => 'Light Purple',
                'purple-dark' => 'Dark Purple',
                'blue'        => 'Light Blue',
                'blue-dark'   => 'Dark Blue',
                'orange'   => 'Orange',
            ];

            // For Dates
            $arrDate = [
                'm/d/Y' => 'MM/DD/YYYY',
                'd/m/Y' => 'DD/MM/YYYY',
                'm-d-Y' => 'MM-DD-YYYY',
                'd-m-Y' => 'DD-MM-YYYY',
            ];

            // For Background Gradient
            $arrGradient = [
                'bg-gradient-primary'   => 'Primary',
                'bg-gradient-secondary' => 'Secondary',
                'bg-gradient-success'   => 'Success',
                'bg-gradient-danger'    => 'Danger',
                'bg-gradient-warning'   => 'Warning',
                'bg-gradient-info'      => 'Info',
                'bg-gradient-dark'      => 'Dark',
            ];

            // For Messages
            $dir      = base_path() . '/resources/lang/en';
            $arrFiles = array_diff(scandir($dir), [
                '..',
                '.',
            ]);

            $arrMessage = [];
            foreach ($arrFiles as $file) {
                $fileName = basename($file, ".php");
                $fileData = include $dir . "/" . $file;
                if (is_array($fileData)) {
                    $arrMessage[$fileName] = $fileData;
                }
            }

            unset($arrMessage['installer_messages']);

            $faqs    = Faq::all();
            $tenants = Tenant::all();
            if(tenant()->manage_news_posts){
                $newsfeeds = Newsfeeds::manageNewsfeeds($userPerms, user()->tenant_id);
            }else{
                $newsfeeds = [];
            }


            $layoutDefinitions             = [];
            $layoutDefinitions['all']      = LayoutDefinition::orderBy('user_group')->get();
            $layoutDefinitions['internal'] = LayoutDefinition::where('user_group', '=', 1)->get()->pluck('title', 'id');
            $layoutDefinitions['external'] = LayoutDefinition::where('user_group', '=', 2)->get()->pluck('title', 'id');
            //$layoutDefinitions['public']   = LayoutDefinition::where('user_group', '=', 3)->get()->pluck('title', 'id');

            $integrations = RestIntegration::where(['integration_type' => 1, 'parent_id' => 0])->get();

            $customPage = CustomPage::all();

            $securityGroup = [];

            //built-in security group
            $securityCheck = ILINX::securityGroup()->setBaseUrl(config('ilinx.ic_url'))->index();
            if ($securityCheck) {
                if ($securityCheck->Success ?? false) {
                    foreach ($securityCheck->Data as $s) {
                        $securityGroup[] = $s->GroupName;
                    }
                } else {
                    $securityGroup = [];
                }
            }

            // external security group
            $extSecurityCheck = ILINX::securityGroup()->setBaseUrl(config('ilinx.ic_url'))->externalGroup();
            if ($extSecurityCheck) {
                if ($extSecurityCheck->Success ?? false) {
                    foreach ($extSecurityCheck->Data as $s) {
                        $securityGroup[] = $s->GroupName;
                    }
                } else {
                    $securityGroup = [];
                }
            }

            sort($securityGroup);

            $modulePermsDefs = [];
            $permsModuleName = ModulePermissionDef::pluck('module_name')->unique();
            $search          = [' ', '&']; //for str_replace

            foreach ($permsModuleName as $module_name) {
                $modulePermsDefs[$module_name]['results'] = ModulePermissionDef::where('module_name', '=', $module_name)->get();
                $modulePermsDefs[$module_name]['code']    = str_replace($search, '_', strtolower(trim($module_name)));
            }

            $mail = MailSetting::first();

            return view('users.setting', compact('themes', 'arrDate', 'arrMessage', 'arrGradient', 'faqs', 'layoutDefinitions', 'tenants', 'integrations', 'customPage', 'mail', 'userGroups', 'modulePermsDefs', 'permsAssignment', 'securityGroup', 'userPerms', 'newsfeeds'));
        }

        return redirect()->back()->with('error', __('Permission Denied.'));
    }

    public function store(Request $request) {
        $tenant = Tenant::where('tenant_id', tenant('tenant_id'))->first();

        $usrData         = Session::get('userInfo');
        $userGroups      = $usrData->UserGroups ?? [];
        $permsAssignment = ModulePermissionAssignment::all();
        $userPerms = ModulePermissionAssignment::userPermissions();

        // if ((user()->account_type == 1 || user()->account_type == 4) && $request->from === 'company_setting') {
        //     $validate = [
        //         'company_name'    => 'required|string',
        //         'company_address' => 'required|string',
        //         'company_city'    => 'required|string',
        //         'company_state'   => 'required|string',
        //         'company_zip'     => 'required|string',
        //         'company_phone'   => 'required|string',
        //     ];

        //     $validator = Validator::make(
        //         $request->all(),
        //         $validate
        //     );

        //     if ($validator->fails()) {
        //         return redirect()->back()->with('error', $validator->errors()->first());
        //     }

        //     $requestData = [
        //         'company_name'  => $request->company_name,
        //         'company_phone' => $request->company_phone,
        //         'address'       => $request->company_address,
        //         'city'          => $request->company_city,
        //         'state'         => $request->company_state,
        //         'zip'           => $request->company_zip,
        //     ];

        //     if ($tenant->count() === 0) {
        //         return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'))->with('tab-status', 'company-setting');
        //     }

        //     if ($tenant->update($requestData)) {
        //         return redirect()->back()->with('success', __('Company Information updated successfully'))->with('tab-status', 'company-setting');
        //     }

        //     return redirect()->route('settings', tenant('tenant_id'))->with('error', __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'))->with('tab-status', 'company-setting');
        // }

        if (user()->account_type == 1) {
            $validate = [];

            if ($request->from == 'mail') {
                $validate = [
                    'mail_driver'       => 'required|string',
                    'mail_host'         => 'required|string',
                    'mail_port'         => 'required|string',
                    'mail_username'     => 'required|string',
                    'mail_password'     => 'required|string',
                    'mail_from_address' => 'required|string',
                    'mail_from_name'    => 'required|string',
                    'mail_encryption'   => 'required|string',
                ];
            } elseif ($request->from == 'pusher') {
                $validate = [
                    'pusher_app_id'      => 'required|string',
                    'pusher_app_key'     => 'required|string',
                    'pusher_app_secret'  => 'required|string',
                    'pusher_app_cluster' => 'required|string',
                ];
            } elseif ($request->from == 'label_message') {
                $validate = [
                    'document_menu'         => 'required|string',
                    'task_menu'             => 'required|string',
                    'activities_menu'       => 'required|string',
                    'help_menu'             => 'required|string',
                    'salutation'            => 'required|string',
                    'single_task_work_item' => 'required|string',
                    'plural_task_work_item' => 'required|string',
                ];
            } elseif ($request->from == 'help_center') {
                $validate = [
                    'help_center_text' => 'required',
                ];
            } elseif ($request->from == 'assign_layout_navigation') {
                $validate = [
                    'internal_layout'           => 'required',
                    'internal_user_layout_mode' => 'required',
                    'external_layout'           => 'required',
                    'external_user_layout_mode' => 'required',
                    'public_mode_layout'        => 'required',
                ];
            }

            if ($request->favicon) {
                $validate = [
                    'favicon' => 'required|mimes:ico,png,jpg,jpeg|max:1024',
                ];
            }
            if ($request->full_logo) {
                $validate = [
                    'full_logo' => 'required|mimes:png,jpg,jpeg|max:1024',
                ];
            }

            if ($request->small_logo) {
                $validate = [
                    'small_logo' => 'required|mimes:png|max:1024',
                ];
            }

            if ($request->poweredby_logo) {
                $validate = [
                    'poweredby_logo' => 'required|mimes:png|max:1024',
                ];
            }

            if ($request->banner) {
                $validate = [
                    'banner' => 'required|mimes:png,jpg,jpeg|max:2048',
                ];
            }

            $validator = Validator::make(
                $request->all(),
                $validate
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            if ($request->favicon) {
                $faviconName = 'favicon.ico';
                // Only one favicon for the entire site
                $request->favicon->storeAs('logo', $faviconName);
            }

            if ($request->full_logo) {
                $logoName = 'logo.' . $request->full_logo->getClientOriginalExtension();
                $logo     = $request->full_logo->storeAs('logo/' . tenant('tenant_id'), $logoName);
                Tenant::where('tenant_id', $tenant->tenant_id)->update(['logo' => $logo]);
            }

            if ($request->small_logo) {
                $existLogo = $tenant->small_logo;
                Utility::checkFileExistsNDelete([$existLogo]);
                $smalllogoName = 'small_logo.' . $request->small_logo->getClientOriginalExtension();
                $path = 'logo/' . tenant('tenant_id');
                $request->small_logo->storeAs($path, $smalllogoName);
            }

            if ($request->poweredby_logo) {
                $existLogo = $tenant->poweredby_logo;
                Utility::checkFileExistsNDelete([$existLogo]);
                $poweredbyName = 'poweredby_logo.' . $request->poweredby_logo->getClientOriginalExtension();
                $path = 'logo/' . tenant('tenant_id');
                $request->poweredby_logo->storeAs($path, $poweredbyName);
            }

            if ($request->banner) {
                $existBanner = tenant('banner');
                Utility::checkFileExistsNDelete([$existBanner]);
                $bannerName = 'banner.' . $request->banner->getClientOriginalExtension();
                $banner     = $request->banner->storeAs('logo/' . tenant('tenant_id'), $bannerName);
                Tenant::where('tenant_id', $tenant->tenant_id)->update(['banner' => $banner]);
            }

            if ($request->from == 'site_setting') {
                $post = $request->all();
                if ($post['default_theme'] == 'purple-dark' || $post['default_theme'] == 'blue-dark') {
                    \DB::table('users')->update(['dark_mode' => 1]);
                } else {
                    \DB::table('users')->update(['dark_mode' => 0]);
                }

                // These properties are stored in [tenants], not [settings]
                $data = [
                    'banner_type'     => $request->banner_type,
                    'show_activities' => isset($request->show_activities) ? 1 : 0,
                    'header_text'     => $request->header_text,
                    'date_format'     => $request->date_format,
                    'day_start'       => $request->day_start,
                    'default_theme'   => $request->default_theme,
                ];

                if ($request->small_logo) {
                    $data['small_logo'] = $request->small_logo ? 'logo/' .tenant('tenant_id') .'/'. $smalllogoName : $tenant->small_logo;
                }

                if ($request->poweredby_logo) {
                    $data['poweredby_logo'] = $request->poweredby_logo ? 'logo/' .tenant('tenant_id') .'/'. $poweredbyName : $tenant->poweredby_logo;
                }

                Tenant::query()->where('tenant_id', tenant('tenant_id'))->update($data);
                unset($post['banner_type'], $post['show_activities'], $post['header_text'], $post['date_format'], $post['day_start'], $post['default_theme'], $post['banner']);
                unset($post['_token'], $post['full_logo'], $post['favicon'], $post['from'], $post['small_logo'],$post['poweredby_logo']);

                $this->updateOrCreateSettings($post, Auth::user());

                return redirect()->back()->with('success', __('Basic Setting updated successfully'))->with('tab-status', 'site-setting');
            }

            if ($request->from == 'help_center') {
                $post = $request->all();

                unset($post['_token'], $post['from']);

                $this->updateOrCreateSettings($post, Auth::user());

                return redirect()->back()->with('success', __('Help Center Setting updated successfully'))->with('tab-status', 'help-center');
            }

            if ($request->from == 'mail') {
                $res = MailSetting::get()->first() ?
                MailSetting::query()->first()->update($validator->validated())
                :
                MailSetting::query()->create($validator->validated());

                if (!$res) {
                    return redirect()->back()->with('error', __('Something is wrong'))->with('tab-status', 'mail-setting');
                }

                return redirect()->back()->with('success', __('Mailer Setting updated successfully'))->with('tab-status', 'mail-setting');
            }

            if ($request->from == 'pusher') {
                $arrEnv = [
                    'PUSHER_APP_ID'      => $request->pusher_app_id,
                    'PUSHER_APP_KEY'     => $request->pusher_app_key,
                    'PUSHER_APP_SECRET'  => $request->pusher_app_secret,
                    'PUSHER_APP_CLUSTER' => $request->pusher_app_cluster,
                ];

                $env = Utility::setEnvironmentValue($arrEnv);

                if ($env) {
                    return redirect()->back()->with('success', __('Pusher Setting updated successfully'))->with('tab-status', 'pusher-setting');
                }

                return redirect()->back()->with('error', __('Something is wrong'))->with('tab-status', 'pusher-setting');
            }

            if ($request->from == 'label_message') {
                $post = $request->all();
                unset($post['_token'], $post['from']);

                $this->updateOrCreateSettings($post, Auth::user());

                return redirect()->back()->with('success', __('Label Setting updated successfully'))->with('tab-status', 'label-message');
            }

            if ($request->from == 'assign_layout_navigation') {
                $post = [];

                if ($request->internal_layout != 'internal_single') {
                    $post['internal_user_layout_mode'] = ($request->internal_layout == 'internal_multi') ? '0' : '-1';
                } else {
                    $post['internal_user_layout_mode'] = $request->internal_user_layout_mode;
                }

                if ($request->external_layout != 'external_single') {
                    $post['external_user_layout_mode'] = ($request->external_layout == 'external_multi') ? '0' : '-1';
                } else {
                    $post['external_user_layout_mode'] = $request->external_user_layout_mode;
                }

                $this->updateOrCreateSettings($post, Auth::user());

                return redirect()->back()->with('success', __('Layout & Navigation Saved Successfully.!'))->with('tab-status', 'assign-layout-navigation');
            }
        } elseif (user()->account_type == 4) {
            if ($request->from == 'external_admin_site_setting') {
                $validate = [];

                if ($request->full_logo) {
                    $validate = [
                        'full_logo' => 'required|mimes:png|max:1024',
                    ];
                }

                if ($request->small_logo) {
                    $validate = [
                        'small_logo' => 'required|mimes:png|max:1024',
                    ];
                }

                if ($request->banner) {
                    $validate = [
                        'banner' => 'required|mimes:png,jpg,jpeg|max:2048',
                    ];
                }

                $validator = Validator::make(
                    $request->all(),
                    $validate
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('error', $validator->errors()->first());
                }

                if ($request->full_logo) {
                    $existLogo = $tenant->logo;
                    Utility::checkFileExistsNDelete([$existLogo]);
                    $logoName = 'logo.' . $request->full_logo->getClientOriginalExtension();
                    $request->full_logo->storeAs('logo/' . tenant('tenant_id'), $logoName);
                }

                if ($request->small_logo) {
                    $existLogo = $tenant->small_logo;
                    Utility::checkFileExistsNDelete([$existLogo]);
                    $smalllogoName = 'small_logo.' . $request->small_logo->getClientOriginalExtension();
                    $request->small_logo->storeAs('logo/' . tenant('tenant_id'), $smalllogoName);
                }

                if ($request->banner) {
                    $existBanner = $tenant->banner;
                    Utility::checkFileExistsNDelete([$existBanner]);
                    $bannerName = $tenant->tenant_id . '_banner.' . $request->banner->getClientOriginalExtension();
                    $request->banner->storeAs('logo', $bannerName);
                }

                $data = [
                    'banner_type'     => $request->banner_type,
                    'show_activities' => isset($request->show_activities) ? 1 : 0,
                    'header_text'     => $request->header_text,
                    'date_format'     => $request->date_format,
                    'day_start'       => $request->day_start,
                    'default_theme'   => $request->default_theme,
                    'logo'            => $request->full_logo ? 'logo/' .tenant('tenant_id') .'/'. $logoName : $tenant->logo,
                    'small_logo'      => $request->small_logo ? 'logo/' .tenant('tenant_id') .'/'. $smalllogoName : $tenant->small_logo,
                    'banner'          => $request->banner ? 'logo/' . $bannerName : $tenant->banner,
                ];

                Tenant::query()->where('tenant_id', tenant('tenant_id'))->update($data);

                // There are no external tenant properties stored in [settings]
                //$this->updateOrCreateSettings($data, Auth::user());

                return redirect()->back()->with('success', __('Basic Setting updated successfully'))->with('tab-status', 'site-setting-external-user');
            }
        } elseif (in_array('FAQ_ALL_CONTENT', $userPerms)) {
            $validate = [];

            if ($request->from == 'help_center') {
                $validate = [
                    'help_center_text' => 'required',
                ];
            }

            $validator = Validator::make(
                $request->all(),
                $validate
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            if ($request->from == 'help_center') {
                $post = $request->all();

                unset($post['_token'], $post['from']);

                $this->updateOrCreateSettings($post, Auth::user());

                return redirect()->back()->with('success', __('Help Center Setting updated successfully'))->with('tab-status', 'help-center');
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function testEmail(Request $request) {
        $user = user();
        if ($user->account_type == 1) {
            $data                      = [];
            $data['mail_driver']       = $request->mail_driver;
            $data['mail_host']         = $request->mail_host;
            $data['mail_port']         = $request->mail_port;
            $data['mail_username']     = $request->mail_username;
            $data['mail_password']     = $request->mail_password;
            $data['mail_encryption']   = $request->mail_encryption;
            $data['mail_from_address'] = $request->mail_from_address;

            return view('users.test_email', compact('data'));
        }

        return response()->json(['error' => __('Permission Denied.')], 401);
    }

    public function testEmailSend(Request $request) {
        $usr = user();

        if ($usr->account_type == 1) {
            $validator = Validator::make($request->all(), [
                'email'             => 'required|email',
                'mail_driver'       => 'required',
                'mail_host'         => 'required',
                'mail_port'         => 'required',
                'mail_username'     => 'required',
                'mail_password'     => 'required',
                'mail_from_address' => 'required',
            ]);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            try {
                Mail::to($request->email)->send(new EmailTest());
            } catch (\Exception$e) {
                return response()->json([
                    'is_success' => false,
                    'message'    => $e->getMessage(),
                ]);
            }

            return response()->json([
                'is_success' => true,
                'message'    => __('Email sent successfully'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function storeMsgData($currantLang, Request $request) {
        if (user()->account_type == 1) {
            $dir = base_path() . '/resources/lang';
            if (!is_dir($dir)) {
                mkdir($dir);
                chmod($dir, 0777);
            }

            $langFolder = $dir . "/" . $currantLang;

            if (!is_dir($langFolder)) {
                mkdir($langFolder);
                chmod($langFolder, 0777);
            }

            if (!empty($request->message)) {
                foreach ($request->message as $fileName => $fileData) {
                    $content = "<?php return [";
                    $content .= $this->buildArray($fileData);
                    $content .= "];";
                    file_put_contents($langFolder . "/" . $fileName . '.php', $content);
                }
            }

            return redirect()->back()->with('success', __('Message Data Save Successfully!'));
        }

        return redirect()->back()->with('error', __('Permission Denied.'));
    }

    public function buildArray($fileData) {
        $content = "";
        foreach ($fileData as $lable => $data) {
            if (is_array($data)) {
                $content .= "'$lable'=>[" . $this->buildArray($data) . "],";
            } else {
                $content .= "'$lable'=>'" . addslashes($data) . "',";
            }
        }

        return $content;
    }

    public function updateValue(Request $request) {
        if (isset($request->setting_name) && !empty($request->setting_name)) {
            $getSetting = \DB::table('settings')->where('name', 'LIKE', $request->setting_name)->get();

            if (!empty($getSetting->first())) {
                $updatedAt = date('Y-m-d H:i:s');
                $record    = $getSetting->first();
                $isUpdate  = \DB::statement("UPDATE settings SET value ='" . $request->setting_value . "',updated_at = '" . $updatedAt . "' where id =" . $record->id);

                if ($isUpdate == true) {
                    $updatedRec  = \DB::table('settings')->where('id', 'LIKE', $record->id)->get();
                    $arrResponse = [
                        'is_success' => "true",
                        'message'    => __('Record updated successfully.'),
                        'data'       => $updatedRec->first(),
                    ];
                } else {
                    $arrResponse = [
                        'is_success' => "false",
                        'message'    => __('An error occurred attempting to update this record.'),
                    ];
                }
            } else {
                $arrResponse = [
                    'is_success' => "false",
                    'message'    => __('Setting name is not found in our records.'),
                ];
            }
        } else {
            $arrResponse = [
                'is_success' => "false",
                'message'    => __('Setting name is required.'),
            ];
        }

        return response()->json($arrResponse);
    }

    private function updateOrCreateSettings(array $post, User $user) {
        foreach ($post as $key => $data) {
            if ($data !== null) {
                // Data in the settings table are not associated with any specific user
                Setting::updateOrCreate(
                    ['name' => $key],
                    ['name' => $key, 'value' => $data]
                );
            }
        }
    }

    public function deletePoweredBy(Request $request)
    {
        $tenant = Tenant::where('tenant_id', 'host')->first();

        if ($tenant->poweredby_logo){
            //checker if they updated and removed image
            $path = storage_path('/app/public/'.$tenant->poweredby_logo);
            if (file_exists($path)) {
                \File::delete($path);
            }
            Tenant::where('tenant_id', tenant('tenant_id'))->update(['poweredby_logo'=>null]);
        }

        return redirect()->back()
            ->with(
                'success',
                __('Poweredby Logo Deleted Successfully.')
            )->with('tab-status', 'site-setting');
    }

    public function deleteSmallLogo(Request $request)
    {
        $tenant = Tenant::where('tenant_id', tenant('tenant_id'))->first();
        //checker if they updated and removed image
        $path = storage_path('/app/public/'.$tenant->small_logo);

        if (file_exists($path)) {
            \File::delete($path);
        }

        Tenant::where('tenant_id', tenant('tenant_id'))->update(['small_logo'=>null]);

        return redirect()->back()
            ->with(
                'success',
                __('Small Logo Deleted Successfully.')
            )->with('tab-status', user()->account_type == 1 ? 'site-setting' : 'site-setting-external-user');
    }
}
