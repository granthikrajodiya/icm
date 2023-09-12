<?php

namespace App\Models;

use App\Facades\ILINX;
use App\Http\Controllers\HomeController;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * App\Models\Utility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Utility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Utility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Utility query()
 * @mixin \Eloquent
 */

/**
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
class Utility extends Model
{
    public const VIEW_SEARCH_FIELD_OPERATORS = [
        0 => '=',
        1 => '>',
        2 => '>=',
        3 => '<',
        4 => '<=',
        5 => 'In Between',
        6 => 'Contains',
        7 => 'Not Contains',
        8 => 'Not Equal',
        9 => 'Starts With',
        10 => 'Ends With',
        11 => 'Is Empty',
        12 => 'Is Not Empty',
        13 => 'Contains Full Text',
        14 => 'Basic',
        15 => 'Advanced',
        16 => 'SqlParam'
    ];

    public static function settings(): array
    {
        // $tenantOwner = tenant()?->getUserOwner() ?? [];

        $data = DB::table('settings')->get();

        $settings = [
            "footer_text"          => "© 2023 ImageSource",
            "footer_link_1"        => "Support",
            "footer_value_1"       => "#",
            "footer_link_2"        => "Terms",
            "footer_value_2"       => "#",
            "footer_link_3"        => "Privacy",
            "footer_value_3"       => "#",
            "terms_conditions"     => "#",
            "welcome_message_ext"  => "",
            "welcome_message_int"  => "",
            "sidebar_editor_bg"    => "#ffffff",
            "sidebar_editor"       => "",
            "bg_gradient"          => "",
            "sidebar_editor_style" => "bg_color",
            "internal_layout"      => "internal_single",
            "external_layout"      => "external_single",
            "salutation"           => "[Good morning|afternoon|evening]",
        ];

        foreach ($data as $row) {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    // Get Value by Name from settings or tenants table
    public static function getValByName($key): string {

		if(env('AGGRESSIVE_CACHE') && Session::has($key))
		{
			// Alert that aggressive cache is ON
			if(!Session::has('AGGRESSIVE_CACHE_ALERTED'))
			{
				Utility::ILINXLog('**************************************');
				Utility::ILINXLog(' ALERT: AGGRESSIVE_CACHE is enabled.  ');
				Utility::ILINXLog('**************************************');
				Session::put('AGGRESSIVE_CACHE_ALERTED', true);
			}
			return Session::get($key);
		}

        // These properties come from the [tenants] table, not settings
        $tenant_props = [
            'logo',
            'banner_type',
            'banner',
            'header_text',
            'default_theme',
            'date_format',
            'day_start',
            'show_activities',
        ];

        // If the requested property is from the [tenants] table, return it
        if (in_array($key, $tenant_props)) {
            // Ensure we have a logged-in user
            if (!empty(user())) {
                $tenant = Tenant::where('tenant_id', user()->tenant_id)->first();
				Session::put($key, $tenant[$key] ?? '');
                return $tenant[$key] ?? '';
            } else {
                // Default to the host settings
                $tenant = Tenant::where('tenant_id', 'host')->first();
				Session::put($key, $tenant[$key] ?? '');
                return $tenant[$key] ?? '';
            }
        }

        $setting = self::settings();
		Session::put($key, $setting[$key] ?? '');
        return $setting[$key] ?? '';
    }

    // Get languages
    public static function languages(): array
    {
        $dir  = resource_path() . '/lang';
        $glob = glob($dir . "*", GLOB_ONLYDIR);

        $arrLang = array_map(
            function ($value) use ($dir) {
                return Str::replace($dir, '', $value);
            },
            $glob
        );

        $arrLang = array_map(
            function ($value) use ($dir) {
                return preg_replace('/[0-9]+/', '', $value);
            },
            $arrLang
        );

        return array_filter($arrLang);
    }

    // Check File is exist and delete these
    public static function checkFileExistsNDelete(array $files): bool
    {
        $status = false;

        foreach ($files as $file) {
            if ($file == 'avatars/avatar.png' || !is_string($file)) {
                continue;
            }

            $status = Storage::delete($file);
        }

        return $status;
    }

    // Save Settings on .env file
    public static function setEnvironmentValue(array $values): bool
    {
        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = Str::substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}='{$envValue}'\n";
                } else {
                    $str = Str::replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }

        $str = Str::substr($str, 0, -1);
        $str .= "\n";

        if (!file_put_contents($envFile, $str)) {
            return false;
        }

        return true;
    }

    // get date formatted
    public static function getDateFormatted($date, $time = false, ?string $dateFormat = null)
    {
        $tenant = tenant();

        if ($dateFormat === null) {
            $dateFormat = self::getSiteContent('date_format');

            if (!isset($tenant['date_format']) || empty($tenant['date_format']) || user()->account_type == 1) {
                $dateFormat = self::getValByName('date_format');
            }
        }

        if ($dateFormat === null || strlen(trim($dateFormat)) == 0 ) {
            $dateFormat = 'n/j/Y';
        }

        try {
            if ($time == true) {
                return date($dateFormat . " H:i A", strtotime($date));
            }

            if (is_numeric(substr($date, 0, 1))) {
                return Carbon::parse($date)->format($dateFormat);
            }

            return Carbon::createFromFormat('M d Y H:i:s:a', $date)->format($dateFormat);
        } catch (Exception $th) {
            return $date;
        }
    }

    // For Delete Directory
    public static function deleteDirectory($dir): bool
    {
        return Storage::deleteDirectory($dir);
    }

    public static function getSalutation(): string
    {
        $key = self::getValByName('salutation');

        $string    = Str::replace(['[', ']'], '', $key);
        $arrString = explode(' ', $string);
        $first     = array_shift($arrString);
        $arrMsg    = explode('|', end($arrString));
        $hour      = Carbon::now()->format('H');

        $newMsg = '';

        if ($hour >= 5 && $hour <= 11) {
            $newMsg = $first . ' ' . $arrMsg[0];
        } else {
            if ($hour >= 12 && $hour <= 18) {
                $newMsg = $first . ' ' . $arrMsg[1];
            } else {
                if ($hour >= 19 || $hour <= 4) {
                    $newMsg = $first . ' ' . $arrMsg[2];
                }
            }
        }

        return $newMsg;
    }

    // Using this function check string is date or not
    public static function isDate($value): bool | string | null
    {
        $date = date_parse($value);

        if ($date['error_count'] !== 0 || $date['warning_count'] !== 0) {
            return $value;
        }

        if (checkdate($date['month'], $date['day'], $date['year']) === false) {
            return $value;
        }

        if ($date['hour'] > 0 || $date['minute'] > 0) {
            return self::getDateFormatted($value, true);
        }

        return self::getDateFormatted($value);
    }


    // formating date on unix setup for formatting
    public static function isDateSortFormat($value): bool | string | null{
        $date = date_parse($value);

        if ($date['error_count'] !== 0 || $date['warning_count'] !== 0) {
            return $value;
        }

        if (checkdate($date['month'], $date['day'], $date['year']) === false) {
            return $value;
        }

        return strtotime($value);
    }

    //URL Encoding for those with slashes
    public static function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

     //URL Decoding for those with slashes
    public static function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), 4 - ((strlen($data) % 4) ?: 4), '=', STR_PAD_RIGHT));
    }

    //*************************** API CALL START HERE ***************************//

    // API call for logout
    public static function ilinxLogout($data = ''): object | string
    {
        if ($data == '' || $data == null) {
            $usrData = Session::get('userInfo');
        } else {
            $usrData = $data;
        }

        $response = ILINX::auth()->logout($usrData->Username);

        if (!empty($response) && $response->Success != 'true') {
            Utility::ILINXLog('ILINXlogout ILINX error: ' . $response->Status);

            return '';
        }

        Utility::ILINXLog('ILINXlogout success');

        return $response;
    }

    // API call for user Registration
    public static function makeRegistration($data): array
    {
        $status = [];

        $userToken = ILINX::auth()->login(
            config('ilinx.registration_user.username'),
            config('ilinx.registration_user.password'),
        );

        if (!empty($userToken) && $userToken->Data->SecurityToken != '') {
            Utility::ILINXLog("ILINX makeRegistration data: ". json_encode($data));

            $activeProfileId = -1;
            $profile = ILINX::batch()->setBaseUrl(config('ilinx.ic_url'))->getProfileIdByName(config('ilinx.active_batch_profile_name'));
            if ($profile->Success) {
                $activeProfileId = $profile->Data;
            } else {
                $status['is_success'] = false;
                $status['msg']        = __('Something went wrong.');
                return $status;
            }

            $response = ILINX::user()->store($data, $userToken->Data->SecurityToken, $activeProfileId);
            Utility::ILINXLog("ILINX makeRegistration Response: ". json_encode($response));

            if (empty($response) || isset($response->Success) ? $response->Success : null ) {

                    if ($response->Success != 'true') {
                        // FAIL
                        $status['is_success'] = false;
                        $status['msg']        = !empty($response)
                        ? '<h5>ILINX error for makeRegistration: ' . $response->ErrorMessage . '</h5>'
                        : '<h5>' . __('Unable to initiate new user registration workflow.') . '</h5>';
                        Utility::ILINXLog("ILINX makeRegistration Fail: Error when saving new user");
                        Utility::ILINXLog($status['msg']);
                        Utility::ILINXLog('ILINX REST response data: ' . json_encode($response));
                        Utility::ILINXLog('ILINX postdata: ' . json_encode($data));
                    } else {
                        $status['is_success'] = true;
                        $status['msg']        = __('Registration approval workflow created!');
                        Utility::ILINXLog("Make Registration Success");
                    }

            } else {
                $status['is_success'] = true;
                $status['msg']        = __('Registration approval workflow created!');
                Utility::ILINXLog("Make Registration Success");
            }

            ILINX::auth()->logout(config('ilinx.registration_user.username'));
        } else {
            $status['is_success'] = false;
            $status['msg']        = '<h5>' . __('ILINX login failed. Unable to initiate new user registration workflow.') . '</h5>';
            Utility::ILINXLog("ILINX makeRegistration Fail: Error with the user token");
        }

        return $status;
    }

    // API call for user Login
    public static function makeLogin($data): object
    {
        if (tenant('tenant_id') !== 'host' || config('ilinx.include_tenant_id') == true) {
            $data['username'] = tenant('tenant_id') . ':' . $data['username'];
        }

        $response = ILINX::auth()->login($data['username'], $data['password']);

        if ($response->Success != 'true') {
            Auth::logout();
        } else {
            if (config('ilinx.host_user_auto_registration') && tenant('tenant_id') === 'host') {
                self::createOrUpdateIlinxUser($response->Data);
            }

            Session::put('userInfo', $response->Data);
        }

        return $response;
    }

    // Function for Make API Log Entry
    public static function ilinxLog($msg)
    {
        Log::info($msg);
    }

    // Function for call Form API Call
    public static function getFormMenu() {

        // Check cache if it has value then delete
        if(Session::has('formsArray')) {
            Session::forget('formsArray');
        }

        // Check cache, only need to retreive forms once
        $formsArray = Session::get('formsArray');

        if (!empty($formsArray)) {
            return $formsArray;
        }

        $response = ILINX::form()->index();

        // Check status
        if ($response->Success != 'true') {
            Utility::ILINXLog("ERROR getFormMenu ILINX REST ERROR: " . $response->ErrorMessage);
        } else {
            Session::put('formsArray', $response);
        }

        return $response;
    }

    // API call for user Password Reset

    /**
     * @throws Exception
     */
    public static function passwordReset($data): array
    {
        $status = [];

        // must login as admin
        $userToken = ILINX::auth()->login(
            config('ilinx.registration_user.username'),
            config('ilinx.registration_user.password'),
        );

        if (!empty($userToken) && $userToken->Data->SecurityToken != '') {

            // add userInfo temporary , will be used in , we will just forget the session afterwards this method
            // app/Services/ILINX/Core/Client.php:90
            Session::put('userInfo', $userToken->Data);

            Utility::ILINXLog("ILINX Reset Password data: ". json_encode($data));
            $response = ILINX::user()->passwordReset($data);
            if (!$response->Success) {
                // FAIL
                $status['is_success'] = false;
                $status['msg']        = __('Unable to reset Password.') ;
                Utility::ILINXLog("ILINX Password Reset Fail: Error when reset new password on user");
                Utility::ILINXLog($response->ErrorMessage);
                Utility::ILINXLog('ILINX REST response data: ' . json_encode($response));
                Utility::ILINXLog('ILINX postdata: ' . json_encode($data));
            } else {
                $status['is_success'] = true;
                $status['msg']        = __('New Password for user is updated!');
                Utility::ILINXLog("Password Reset Success");
            }
        } else {
            $status['is_success'] = false;
            $status['msg']        = '<h5>' . __('ILINX login failed. Unable to initiate Password Reset.') . '</h5>';
            Utility::ILINXLog("ILINX makeRegistration Fail: Error with the user token");
        }

        //removing userInfo in session after used in Client getCredentials()
        Session::forget('userInfo');
        return $status;
    }

    //*************************** API CALL END HERE ***************************//

    // Fetch Some Table & Documents Data
    public static function getTableRowColumnValue($rowValuesArray, $columnName): string
    {
        $retVal = '';
        foreach ($rowValuesArray as $value) {
            if ($value->Name == $columnName) {
                $retVal = $value->Value;
            }
        }

        return $retVal;
    }

    public static function getDocProp($docObj, $propName): string | null
    {
        $retVal = 'Untitled';

        if (!empty($docObj)) {
            foreach ($docObj->IndexValues as $value) {
                if ($value->IndexName == $propName) {
                    $retVal = $value->IndexValue;
                }
            }
        }

        if ($retVal == null) {
            return 'Untitled';
        }

        return $retVal;
    }

    public static function getDocDynamicIndexes($indexArray): array
    {
        $retValArray = [];

        foreach ($indexArray->IndexValues as $value) {
            if (Str::substr($value->IndexName, 0, 4) == "ICM_") {
                $retValArray[] = $value;
            }
        }

        return $retValArray;
    }

    public static function getTableRowDynamicIndexes($rowValuesArray): array
    {
        $retValArray = [];

        foreach ($rowValuesArray->IndexValues as $value) {
            if (Str::substr($value->IndexName, 0, 4) == "ICM_") {
                $retValArray[] = Str::substr($value->IndexName, 4);
            }
        }

        return array_unique($retValArray);
    }

    public static function getBatchTableRowDynamicIndexes($rowValuesArray): array
    {
        $retValArray = [];

        foreach ($rowValuesArray as $value) {
            if (Str::substr($value->Name, 0, 4) == "ICM_") {
                $retValArray[] = $value;
            }
        }

        return $retValArray;
    }
    // End Fetch Table & Documents Data

    // Get Dynamic Document
    public static function getUniqueMenu(): array | RedirectResponse
    {
        $usrData = Session::get('userInfo');

        if (empty($usrData)) {
            return redirect('login', tenant('tenant_id'));
        }

        $menuData = HomeController::getMenu();
        $docTypes = [];

        foreach ($menuData->Docs as $docObj) {
            if (!empty($docObj->DocTypeName)) {
                $docTypes[] = $docObj->DocTypeName;
            }
        }

        return array_unique($docTypes);
    }

    // Get Dynamic Child Batches
    public static function getUniqueChild(): array | RedirectResponse
    {
        $usrData = Session::get('userInfo');

        if (empty($usrData)) {
            return redirect('login', tenant('tenant_id'));
        }

        $menuData   = HomeController::getMenu();
        $childBatch = [];

        foreach ($menuData->IndexValues as $indexValue) {
            if ($indexValue->DataType == '_table' && count($indexValue->TableValue->RowValues) > 0 && self::checkChildEmpty($indexValue->TableValue->RowValues[0]) == false) {
                $childBatch[] = $indexValue->IndexName;
            }
        }

        return array_unique($childBatch);
    }

    // Get Dynamic new count of document
    public static function newCount($data): string
    {
        $lastLogin = Carbon::parse(Session::get('last_login_at'))->timestamp;
        $cnt       = 0;

        if (count($data) > 0) {
            foreach ($data as $val) {
                $removeChar = Str::replace(str_split('/()Date'), '', $val->DateCreated);
                $newDate    = Str::substr(explode('-', $removeChar)[0], 0, -3);

                if ($newDate > $lastLogin) {
                    $cnt++;
                }
            }
        }

        return $cnt . ' ' . __('New');
    }

    // Check Child is Empty or not
    public static function checkChildEmpty($data): bool
    {
        $isEmpty = true;

        foreach ($data->ColumnValues as $row) {
            if ($row->Name == 'Title') {
                $isEmpty = empty($row->Value);
            }
        }

        return $isEmpty;
    }

    //generate a username from Full name
    public static function generateUsername(string $stringName = "Hello World", $randNo = 200): string
    {
        $usernameParts = array_filter(explode(" ", strtolower($stringName))); //explode and lowercase name
        $usernameParts = array_slice($usernameParts, 0, 2); //return only first two arry part

        $part1 = !empty($usernameParts[0]) ? substr($usernameParts[0], 0, 8) : ""; //cut first name to 8 letters
        $part2 = !empty($usernameParts[1]) ? substr($usernameParts[1], 0, 5) : ""; //cut second name to 5 letters
        $part3 = $randNo ? rand(0, $randNo) : "";

        $username = $part1 . str_shuffle($part2) . $part3; //str_shuffle to randomly shuffle all characters

        $exist = User::where('username', '=', $username)->first();
        if (!empty($exist)) {
            $username = self::generateUsername($stringName);
        }

        return $username;
    }

    public static function getSiteContent($name): string {
        // These properties come from the [tenants] table, not settings
        $tenant_props = [
            'logo',
            'banner_type',
            'banner',
            'header_text',
            'default_theme',
            'date_format',
            'day_start',
            'show_activities',
        ];

        // If the requested property is from the [tenants] table, return it
        if (in_array($name, $tenant_props)) {
            $tenant = tenant();
            // this for double checking , since returning empty string on default_theme
            // will load the blank css file: Utility::getSiteContent('default_theme').'.css')
            // resources/views/components/layouts/auth.blade.php:18
            if (empty($tenant[$name]) && $name = 'default_theme') {
                $tenant[$name] = 'ilinx';
            }
            return $tenant[$name] ?? '';
        }

        return self::getValByName($name) ?? '';
    }

    private static function getIfTenantIsEmptyOrNull(string $accountType, string $name, Tenant $tenant): void
    {
        if (!isset($tenant[$name]) || empty($tenant[$name]) || $accountType == 1) {
            if ($name == 'logo') {
                return;
            }

            self::getValByName($name);
        } else {
            $tenant[$name];
        }

        self::getValByName($name);
    }

    private static function createOrUpdateIlinxUser($data) {

        $isAdmin = null;
        if (!$data->IsAdmin) {
            // Explode data from .env HOST_ADMIN_SECURITY_GROUP
            $securityGroup = explode(', ', env('HOST_ADMIN_SECURITY_GROUP'));
            // Check data from .env HOST_ADMIN_SECURITY_GROUP and the UserGroups array if there is matching records found
            $checkUserGroup = array_intersect($securityGroup, $data->UserGroups);

            if (count($checkUserGroup) > 0) {
                $isAdmin = User::INTERNAL_TENANT_ADMIN;
            } else {
                $isAdmin = User::INTERNAL_TENANT_USER;
            }
        } else {
            $isAdmin = User::INTERNAL_TENANT_ADMIN;
        }

        User::updateOrCreate(
            ['username' => $data->Username],
            [
                'username'               => $data->Username,
                'name'                   => $data->FullName,
                'email'                  => $data->EmailAddress,
                'account_type'           => $isAdmin,
                'last_login'             => Carbon::now(),
                'tenant_id'              => 'host',
                'account_status'         => 'active',
                'account_status_message' => 'Internal user',
                'lang'                   => 'en',
                'chat_user'              => '1',
                'messenger_color'        => '#2180f3',
                'password'               => 'nullable',
                'ilinx_user_type'        => $data->UserType,
            ]
        );
    }

    public static function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public static function irdSettings(): array
    {
        $settings = [];
        $tenantId = Auth::user()->tenant_id;
        $tenant = Tenant::where(['tenant_id' => $tenantId])->first();

        $data = DB::table('ird_settings')
            ->where('tenant_id', '=', $tenant->id)
            ->get();


        foreach ($data as $row) {
            $value = $row->value;
            if ($row->type === 'boolean') {
                if ($value == 1) {
                    $value = true;
                } else {
                    $value = false;
                }
            }
            $settings[$row->name] = $value;
        }

        return $settings;
    }

    // Get Configuration Value by Name from settings table
    public static function getIrdSettingByName($key): string
    {
        $setting = self::irdSettings();

        return $setting[$key] ?? '';
    }

    /**
     * Replace text in content with associate array
     *
     * @param string $content
     * @param array $changeData
     * @return string
     */
    public static function replaceTextForContent(string $content, array $changeData): string
    {
        foreach ($changeData as $k => $v) {
            $content = str_replace($k, $v, $content);
        }

        return $content;
    }

    public static function getViewSearchFieldOperators($availableOperators)
    {
        return array_intersect_key(self::VIEW_SEARCH_FIELD_OPERATORS, array_flip($availableOperators));
    }
}
