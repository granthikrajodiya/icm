<?php

namespace App\Http\Controllers;

use App\Facades\ILINX;
use App\Mail\EmailTest;
use App\Mail\PasswordResetEmail;
use App\Models\PasswordResetTokens;
use App\Models\User;
use App\Models\Utility;
use App\Services\Authentication\AuthenticationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    public function __construct()
    {
        $this->middleware('mail.config')->only('sendToken');
    }

    // Custom Password Reset Page
    public function request(AuthenticationService $authentication)
    {
        if (\Auth::check()) {
            return redirect()->route('home');
        }

        $tenantId = !empty(tenant('tenant_id')) ? tenant('tenant_id') : 'host';

        if ($authentication->usesExternalAuthentication()) {
            $url = $authentication->withTenantService()->getLoginUrl();
            return \Redirect::to($url);
        } elseif ($tenantId != 'host') {
            // show request password reset link
            return view('password_reset.email', compact('tenantId'));
        }

        // allow to show password reset to all user except external Auth
        return view('password_reset.email', compact('tenantId'));
    }

    public function sendToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'       => 'required|email:rfc,dns',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => $validator->errors()->first('email')]);
        }

        // check email within tenant
        $user = User::where('tenant_id', tenant('tenant_id'))->where('email', $request->email)->first();
        if (empty($user)) {
            return redirect()->back()->withErrors(['email' => __("We don't have an account for that email.")]);
        }

        //save token to custom PasswordReset Table
        $model = PasswordResetTokens::where('email', $request->get('email'))->first();
        if (empty($model)) {
            $model = new PasswordResetTokens();
        }

        $token = $model->create($user);

        $resetUrl= url(env('app.config').route('password.reset.form', [tenant('tenant_id'), 'token' => $token], false));

        $email = new PasswordResetEmail([
            'link'          => $resetUrl
        ]);

        try {
            Mail::to($request->get('email'))->send($email);
        } catch (\Exception $e) {
            $smtpError = __('E-Mail has been not sent due to SMTP configuration');
            return redirect()->back()->withErrors(['email' => $smtpError]);
        }

        return redirect()->back()->with(['success'=> true, 'email' => $request->get('email')]);
    }

    public function showResetForm($token)
    {
        $model = PasswordResetTokens::where('token', $token)->first();

        if ($model) {
            return view('password_reset.reset', compact('token'))->with(['token' => $token]);
        }

        $tenantId = tenant('tenant_id');
        $message = __("Password reset token has been expired. Please initiate a new password reset request.");
        return view('password_reset.show_information', compact('tenantId', 'message'));
    }

    public function showResetAdminForm($user_id)
    {
        // check email within tenant
        $user = User::find($user_id);
        if (empty($user)) {
            return redirect()->back()->withErrors(['email' => __("We don't have an account for that email.")]);
        }

        //save token to custom PasswordReset Table
        $model = PasswordResetTokens::where('email', $user->email)->first();
        if (empty($model)) {
            $model = new PasswordResetTokens();
        }

        $token = $model->create($user);
        $username = $user->username;
        $tenant_id = $user->tenant_id;
        return view('password_reset.reset', compact('token','username','tenant_id'))
            ->with(['token' => $token, 'username' => $username, 'tenant_id'=>$tenant_id]);
    }

    /**
     * @throws \Exception
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'username' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // check if token exist custom Password Reset
        $model = PasswordResetTokens::where('token', $request->get('token'))
            ->where('tenant_id', tenant('tenant_id'))
            ->first();

        if (empty($model)) {
            return redirect()->back()->withErrors(['username' => __("Account not found.")]);
        }

        // check if email , username , and tenant_id is match
        $objUser = User::where('tenant_id', $request->get('tenant_id') ? $request->get('tenant_id') : tenant('tenant_id'))
            ->where('username', $request->get('username'))
            ->where('email', $model->email)
            ->first();

        if (empty($objUser)) {
            return redirect()->back()->withErrors(['username' => __("Account not found.")]);
        } elseif ($objUser->ilinx_user_type != User::ILINX_USER_TYPE) {
            // show not allowed to reset if not Builtin
            $notAllowed = true;
            return view('password_reset.show_information', compact('notAllowed'));
        }

        //hash password for ILINX and model update
        $dataParam = [
            "UserNameToReset"      => ($objUser->tenant_id == 'host') ? $objUser->username : $objUser->tenant_id. ":" .$objUser->username,
            "NewPassword"   => $request->get('password'),
        ];

        /******** START API CALL to UPDATE ILINX */
        $apiResp = Utility::passwordReset($dataParam);
        if (!$apiResp['is_success']) {
            return redirect()->back()->withErrors(['username' => $apiResp['msg']]);
        }
        /******** END API CALL to UPDATE ILINX */

        User::where('tenant_id', tenant('tenant_id'))
            ->where('username', $request->get('username'))
            ->where('email', $model->email)
            ->update([
                'password'           => Hash::make($request->get('password')),
                'password_change_at' => Carbon::now()->toDateTimeString(),
            ]);

        $model->delete();

        $message =  __('Your password has been reset.');
        return view('password_reset.show_information', compact('message'));
    }
}
