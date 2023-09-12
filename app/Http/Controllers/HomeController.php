<?php

namespace App\Http\Controllers;

use App\Actions\GetCalendarFormattedData;
use App\Facades\ILINX;
use App\Models\Calendar;
use App\Models\LayoutDefinition;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Utility;
use App\Services\Authentication\AuthenticationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * @SuppressWarnings(PHPMD)
 */
class HomeController extends Controller
{
    public function index()
    {
        $usrData = Session::get('userInfo');
        if (empty(tenant('tenant_id'))) {
            // redirect to Tenant Home using session TenantId if exist
            if ($usrData && $usrData->TenantId){
                return redirect()->route('home', $usrData->TenantId);
            }

            return view('landing.index');
        }

        if (Auth::check() && !empty($usrData)) {
            if (empty(user()->password_change_at) && env('NEW_USERS_MUST_CHANGE_PASSWORD') == true) {
                return redirect()->route('change.password', tenant('tenant_id'));
            }

            if (tenant('require_two_factor_authentication') && Session::has('two_factor') === false) {
                return redirect()->route('two-factor.index', tenant('tenant_id'));
            }

            Session::put('navigation_title', 'home');

            $objUser = user();

            $calendars = Calendar::filterAccountType($objUser)->get();

            $arrData = GetCalendarFormattedData::execute($calendars);

            $dataBatch = self::getMenu();
            $dataDoc   = [];

            // Get Dynamic Layout
            if ($objUser->account_type == 0 || $objUser->account_type == 4) {
                // External users might have a primary batch, might not
                if (!empty($dataBatch) && !empty($dataBatch->BatchID)) {
                    $objBatch = self::getBatchDocs($dataBatch->BatchID);
                    foreach ($objBatch->Data as $d) {
                        $dataDoc[$d->DocTypeName][] = $d;
                    }
                }
            }

            // Dynamic layout

            $responseArr = [];
            $customHtmlTitles = [];

            $arrLayouts = LayoutDefinition::layoutDefinitions()->toArray();
            if (count($arrLayouts) > 0) {
                if (in_array($objUser->layout_definition, array_keys($arrLayouts))) {
                    $firstLayout      = $objUser->layout_definition;
                    $layoutDefinition = LayoutDefinition::find($objUser->layout_definition);
                } else {
                    $firstLayout      = array_keys($arrLayouts)[0];
                    $layoutDefinition = LayoutDefinition::find($firstLayout);
                }

                if ($objUser->layout_definition != $firstLayout) {
                    $objUser->layout_definition = $firstLayout;
                    $objUser->save();
                }

                $responseArr['top'] = $layoutDefinition->layouts()
                    ->where('position', 'LIKE', 'top')
                    ->orderBy('order_no', 'ASC')
                    ->get();

                $customHtmlTitles =  $this->findNeedleHaystackArray('title', 'content_type', "Custom HTML", $responseArr['top'], $customHtmlTitles);

                $responseArr['middle'] = $layoutDefinition->layouts()
                    ->where('position', 'LIKE', 'middle')
                    ->orderBy('order_no', 'ASC')
                    ->get();

                $customHtmlTitles =  $this->findNeedleHaystackArray('title', 'content_type', "Custom HTML", $responseArr['middle'], $customHtmlTitles);

                $responseArr['bottom'] = $layoutDefinition->layouts()
                    ->where('position', 'LIKE', 'bottom')
                    ->orderBy('order_no', 'ASC')
                    ->get();

                $customHtmlTitles =  $this->findNeedleHaystackArray('title', 'content_type', "Custom HTML", $responseArr['bottom'], $customHtmlTitles);
                $responseArr['layout_type']        = $layoutDefinition->fixed_layout;
                $responseArr['top_card_height']    = $layoutDefinition->top_card_height . 'px';
                $responseArr['middle_card_height'] = $layoutDefinition->middle_card_height . 'px';
                $responseArr['bottom_card_height'] = $layoutDefinition->bottom_card_height . 'px';

                Session::put('navigation_layout', $layoutDefinition->navigation_layout);

            } else {
                $responseArr = ['top' => [], 'middle' => [], 'bottom' => []];
            }

            return view('admin.dashboard', compact('arrData', 'usrData', 'dataBatch', 'dataDoc', 'responseArr'));
        }

        $tenantId = !empty(tenant('tenant_id')) ? tenant('tenant_id') : 'host';

        return view('landing.index', compact('tenantId'));
    }

    //Find ( title, content_type, 'Custom HTML', layout_array, customtitle array)
    public static function findNeedleHaystackArray($needle, $needle_key, $needle_value, $haystack_array, $storage_array)
    {
        foreach($haystack_array as $arr){
            if($arr[$needle_key] == $needle_value){
                $storage_array[] = $arr[$needle];
            }
        }

        return $storage_array;
    }

    // API CALLS
    public static function getCaseBatch($batchId)
    {
        $usrData = Session::get('userInfo');

        // Check the age of the caseBatch object in the cache
        $caseBatchCacheTime = Session::get('caseBatchCacheTime');

        if (!empty($caseBatchCacheTime)) {
            if (time() - $caseBatchCacheTime < env('ILINX_CACHE_TIMEOUT')) {
                // Our cache is fresh, return the cached object
                $caseBatchObj = Session::get('caseBatchObj');
                if (!empty($caseBatchObj)) {
                    return $caseBatchObj;
                }
            }
        }

        $caseBatch = ILINX::batch()->show($batchId);

        if ($caseBatch->Success == true) {
            // Update the primary caseBatchObj into the cache and store the time
            Session::put('caseBatchCacheTime', time());
            Session::put('caseBatchObj', $caseBatch);
        } else {
            Utility::ILINXLog('getCaseBatch ILINX error: ' . $caseBatch->ErrorMessage);
        }

        return $caseBatch;
    }

    public static function getBatchDocs($batchId)
    {
        // Check the age of the batchDoc object in the cache
        $batchDocsObjCacheTime = Session::get('batchDocsObjCacheTime');
        if (!empty($batchDocsObjCacheTime)) {
            if (time() - $batchDocsObjCacheTime < env('ILINX_CACHE_TIMEOUT')) {
                // Our cache is fresh, return the cached object
                $cachedBatchDocsObj = Session::get('batchDocObj');
                if (!empty($cachedBatchDocsObj)) {
                    return $cachedBatchDocsObj;
                }
            }
        }

        $caseBatch = ILINX::docs()->index($batchId);

        if (!empty($caseBatch) && $caseBatch->Success == true) {
            // Update the batch docs into the cache and store the time
            Session::put('batchDocsObjCacheTime', time());
            Session::put('batchDocObj', $caseBatch);
        } else {
            Utility::ILINXLog('getBatchDocs ILINX error: ' . $caseBatch->ErrorMessage);
        }

        return $caseBatch;
    }

    public static function getMenu()
    {
        $usrData  = Session::get('userInfo');
        $dataMenu = '';

        // Check the age of the batch object in the cache
        $batchObjCacheTime = Session::get('batchObjCacheTime');
        if (!empty($batchObjCacheTime)) {
            // PLEASE MAKE THIS A CONFIGURATION SETTING IN .ENV
            if (time() - $batchObjCacheTime < env('ILINX_CACHE_TIMEOUT')) {
                // Our cache is fresh, return the cached object
                $cachedBatchObj = Session::get('batchObj');
                if (!empty($cachedBatchObj)) {
                    return $cachedBatchObj;
                }
            }
        }

        // Get the primary case BatchID, this should never change for the user
        $batchId = Session::get('BatchID');

        // Should have a BatchID at this point
        if (!empty($batchId)) {
            $response = self::getCaseBatch($batchId);

            if (isset($response->Success) && $response->Success == true) {
                $dataMenu = $response->Data;

                // Update the primary batchObject into the cache and store the time
                Session::put('batchObjCacheTime', time());
                Session::put('batchObj', $dataMenu);
            }
        }

        return $dataMenu;
    }

    public static function getDocById($batchId, $docId)
    {
        return ILINX::docs()->setBaseUrl(config('ilinx.ic_url'))->show($batchId, $docId);
    }

    // END API CALLS

    // View as Public Mode and login silent user
    public function viewAsPublic()
    {
        if (Auth::check()) {
            return redirect()->back()->with('error', __('Please Logout and try again.'));
        }

        $input = [
            'username' => env('IRD_PUBLIC_USER'),
            'password' => env('IRD_PUBLIC_PASS'),
        ];

        $user = User::where('username', '=', $input['username'])->first();

        if (!empty($user)) {
            // Make call that set session and get data from api
            $isLogin = Utility::makeLogin($input);

            if ($isLogin == true) {
                if (Auth::loginUsingId($user->id)) {
                    $user->update(['last_login_at' => Carbon::now()->toDateTimeString()]);

                    return redirect()->route('home', tenant('tenant_id'));
                }

                return redirect()->route('login', tenant('tenant_id'))->withErrors([
                    'username' => __('This system is not configured for public access.'),
                ]);
            }

            return redirect()->route('login', tenant('tenant_id'))->withErrors([
                'username' => __('This system is not configured for public access.'),
            ]);
        }

        return redirect()->route('login', tenant('tenant_id'))->withErrors([
            'username' => __('This system is not configured for public access.'),
        ]);
    }

    // When User Logged as First time after registration from Tenant
    public function changePassword(AuthenticationService $authentication)
    {
        if (Auth::check()) {
            if ($authentication->usesExternalAuthentication()) {
                $url = $authentication->withTenantService()->getLoginUrl();

                return \Redirect::to($url);
            }

            $objUser = user();
            if (empty($objUser->password_change_at) && env('NEW_USERS_MUST_CHANGE_PASSWORD') == true) {
                $tenantId = tenant('tenant_id') ?? "host";

                return view('auth.change-password', compact('tenantId'));
            }

            return redirect()->route('home', tenant('tenant_id'));
        }

        return redirect()->route('home', tenant('tenant_id'));
    }

    public function updatePassword(Request $request)
    {
        if (tenant('authentication_service') == Tenant::AUTH_SERVICE_OKTA || tenant('authentication_service') == Tenant::AUTH_SERVICE_AAD) {
            return redirect()->back()->with('error', __("SSO Users can't change password."));
        }

        $this->validate($request, [
            'current_password'      => 'required',
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ]);

        $objUser = user();
        $post    = $request->all();

        if (Hash::check($post['current_password'], $objUser->password)) {
            if (Hash::check($post['password'], $objUser->password)) {
                return redirect()->back()->withErrors(['password' => __('New Password is same as Current Password')]);
            }

            // API CALL FOR CHANGE PASSWORD
            $objRequest               = new \stdClass();
            $objRequest->old_password = $post['current_password'];
            $objRequest->new_password = $post['password'];

            $resp = UserController::userProfileUpdate($objRequest);

            if ($resp->Success == false) {
                return redirect()->back()->withErrors(['extra_error' => $resp->ErrorMessage]);
            }

            $objUser->update([
                'password'           => Hash::make($post['password']),
                'password_change_at' => Carbon::now()->toDateTimeString(),
            ]);

            if (Session::get('first_time') == true) {
                Session::forget('first_time');
            }

            Session::put('first_time', 'true');

            return redirect()->route('home', tenant('tenant_id'))->with('success', __('New Password set successfully'));
        }

        return redirect()->back()->withErrors(['current_password' => __('Current Password is Invalid')]);
    }
    // End
}
