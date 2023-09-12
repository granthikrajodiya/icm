<?php

namespace App\Http\Controllers;

use App\Actions\Seed\NewTenantSeeder;
use App\Models\SsoConfiguration;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Utility;
use App\Services\Authentication\IlinxAuthenticationService;
use App\Services\Authentication\SsoConfigurationAuthenticationService;
use Illuminate\Contracts\Validation\Validator as MakeValidator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class TenantController extends Controller {
    use AuthenticatesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (user()->account_type == 1) {
            return redirect()->route('settings', tenant('tenant_id'));
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $usr = user();
        if ($usr->account_type == 1) {
            $validator = $this->validateStoreTenant($request);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first())->with('tab-status', 'tenant-layout');
            }

            $tenant = Tenant::create([
                'tenant_id'                         => $request->tenant_id,
                'company_name'                      => $request->company_name,
                'company_phone'                     => $request->company_phone,
                'address'                           => $request->address,
                'city'                              => $request->city,
                'state'                             => $request->state,
                'zip'                               => $request->zip,
                'account_status'                    => $request->account_status,
                'message'                           => $request->message,
                'authentication_service'            => $request->authentication_service,
                'require_two_factor_authentication' => $request->has('require_two_factor_authentication'),
                'manage_news_posts'                 => $request->has('manage_news_posts') ? $request->manage_news_posts : 0,
                'user_register'                     => $request->has('user_register') ? $request->user_register : 0,
                'banner_type'                       => 'color',
                'header_text'                       => 'ILINX Engage',
                'default_theme'                     => 'ilinx',
                'date_format'                       => 'm/d/Y',
                'day_start'                         => '09:00',
                'branding_level'                    => $request->branding_level,
            ]);

            if ($request->authentication_service == Tenant::AUTH_SERVICE_OKTA) {
                $this->storeOktaInformations($request, $tenant);
            }

            if ($request->authentication_service == Tenant::AUTH_SERVICE_AAD) {
                $this->storeAADInformations($request, $tenant);
            }

            if (isset($tenant->tenant_id) && !empty($tenant->tenant_id)) {
                $tenantUser = User::create([
                    'name'                   => $request->name,
                    'username'               => $request->username,
                    'email'                  => $request->email,
                    'password'               => Hash::make($request->password),
                    'created_by'             => user()->id,
                    'account_type'           => User::EXTERNAL_TENANT_ADMIN,
                    'account_status'         => 'pending',
                    'account_status_message' => config('message.register_message'),
                    'tenant_id'              => $tenant->tenant_id,
                ]);

                NewTenantSeeder::execute($tenantUser);

                $registerUser = [
                    'id'                   => $tenantUser->id,
                    'name'                 => $request->name,
                    'username'             => $request->username,
                    'email'                => $request->email,
                    'password'             => $request->password,
                    'tenant_id'            => $tenant->tenant_id,
                    'company_name'         => $request->company_name,
                    'tenant_contact_name'  => $request->name,
                    'tenant_contact_email' => $request->email,
                    "account_type"         => User::EXTERNAL_TENANT_ADMIN,
                ];

                // Make API Call Here for Registration
                $apiResp = Utility::makeRegistration($registerUser);
                $results = false;

                if (isset($apiResp['is_success']) ? $apiResp['is_success'] : $results) {
                    if ($apiResp['is_success'] == true) {
                        // Assign Primary User to Tenant
                        $currTenant = Tenant::where(['tenant_id' => $tenant->tenant_id])->first();
                        Utility::ILINXLog("if tenant exist" . json_encode($currTenant));
                        if (!is_null($currTenant)) {
                            Utility::ILINXLog("if tenant user -> id" . $tenantUser->id);
                            $cnt = Tenant::where(['tenant_id' => $tenant->tenant_id])->update(['primary_contact' => $tenantUser->id]);
                            Utility::ILINXLog("updating tenant primary contact" . json_encode($cnt));
                        }

                        return redirect()->route('settings', tenant('tenant_id'))->with(
                            'success',
                            __('Tenant successfully created!')
                        )->with('tab-status', 'tenant-layout');
                    }

                }

                // Delete User if API Response is false
                $tenantUser->delete();

                Utility::ILINXLog("after tenant User delete" . json_encode($apiResp));

                return redirect()->route('settings', tenant('tenant_id'))->with(
                    'error',
                    __('An error occurred attempting to assign this user.')
                )->with('tab-status', 'tenant-layout');
            }

            return redirect()->route('settings', tenant('tenant_id'))->with(
                'error',
                __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.')
            )->with('tab-status', 'tenant-layout');
        }

        return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'));
    }

    public function show($id) {
        return redirect()->route('settings', tenant('tenant_id'));
    }

    public function edit($selectedTenant) {
        $tenant = Tenant::where(['tenant_id' => $selectedTenant])->first();
        if (empty($tenant) || user()->account_type != User::INTERNAL_TENANT_ADMIN) {
            return redirect()->route('settings', tenant('tenant_id'))->with('error', __('Permission Denied.'));
        }

        $accountType     = ($tenant->tenant_id == 'host') ? User::INTERNAL_TENANT_ADMIN : User::EXTERNAL_TENANT_ADMIN;
        $primaryContacts = User::where('tenant_id', $tenant->tenant_id)->where(
            'account_type',
            $accountType
        )->get()->pluck('name', 'id');

        $isEmailExist = \App\Models\MailSetting::exists();
        return view('tenants.edit', compact('tenant', 'primaryContacts', 'isEmailExist'));
    }

    public function update(Request $request, $selectedTenant) {
        $tenant = Tenant::where(['tenant_id' => $selectedTenant])->first();

        if (!is_null($tenant)) {
            if (user()->account_type == User::INTERNAL_TENANT_ADMIN) {
                $validator = $this->validateUpdateTenant($request, $tenant);

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first())->with('tab-status', 'tenant-layout');
                }

                $oldUser                   = $tenant->primary_contact;
                $data                      = $request->all();
                $data['manage_news_posts'] = $request->has('manage_news_posts') ? $request->manage_news_posts : 0;
                $data['user_register'] = $request->has('user_register') ? $request->user_register : 0;
                $data['account_status']    = ($tenant->tenant_id != 'host') ? $request->account_status : $tenant->account_status;
                Utility::ILINXLog("data tenant request all" . json_encode($data));

                if ($tenant->authentication_service != $request->authentication_service) {
                    $sso_configurations = SsoConfiguration::where(['tenant_id' => $tenant->id])->get();
                    foreach ($sso_configurations as $ssos) {
                        $ssos->delete();
                    }
                }

                if ($request->authentication_service == Tenant::AUTH_SERVICE_OKTA) {
                    $this->storeOktaInformations($request, $tenant);
                }

                if ($request->authentication_service == Tenant::AUTH_SERVICE_AAD) {
                    $this->storeAADInformations($request, $tenant);
                }

                unset($data['_token']);
                unset($data['_method']);
                unset($data['created_date']);
                unset($data['okta_autocreate_authenticated_users']);
                unset($data['okta_login_url']);
                unset($data['okta_issuer_url']);
                unset($data['okta_logout_url']);
                unset($data['okta_certificate_file']);
                unset($data['okta_key_file']);
                unset($data['aad_autocreate_authenticated_users']);
                unset($data['aad_login_url']);
                unset($data['aad_issuer_url']);
                unset($data['aad_logout_url']);
                unset($data['aad_certificate_file']);
                unset($data['aad_key_file']);

                $data['primary_contact'] = isset($data['primary_contact']) ? (int) $data['primary_contact'] : null;

                $data['require_two_factor_authentication'] = $request->has('require_two_factor_authentication');
                Utility::ILINXLog("data tenant update" . json_encode($data));

                Tenant::where('tenant_id', $tenant->tenant_id)->update($data);


                // This causes an email to be sent to all tenant users - this is not valid
                //TenantSaved::dispatch(
                //    $tenant,
                //    (bool) $tenant->require_two_factor_authentication != $request->has('require_two_factor_authentication')
                //);

                // If Primary Contact Update
                if ($oldUser != $request->primary_contact) {
                    User::where('id', $request->primary_contact)->update([
                        'tenant_id' => $tenant->tenant_id,
                    ]);
                }

                if ($tenant->authentication_service != $request->authentication_service && $tenant->tenant_id == tenant('tenant_id')) {
                    return $this->logout($request, $tenant->authentication_service);
                }

                return redirect()->back()->with('success', __('Tenant successfully updated!'))->with(
                    'tab-status',
                    'tenant-layout'
                );
            }

            return redirect()->route('settings', tenant('tenant_id'))->with(
                'error',
                __('Permission Denied.')
            )->with('tab-status', 'tenant-layout');
        }

        return redirect()->route('settings', tenant('tenant_id'))->with(
            'error',
            __('Permission Denied.')
        )->with('tab-status', 'tenant-layout');
    }

    public function storeOktaInformations(Request $request, Tenant $tenant) {
        $tenantFolder = 'okta_information/' . $tenant->tenant_id;

        $data = [
            'autocreate_authenticated_users' => $request->input('okta_autocreate_authenticated_users', false),
            'login_url'                      => $request->okta_login_url,
            'issuer_url'                     => $request->okta_issuer_url,
            'logout_url'                     => $request->okta_logout_url,
            'sso_type'                       => Tenant::AUTH_SERVICE_OKTA,
        ];

        if ($request->okta_certificate_file) {
            $certificateName          = 'certificate_file.cer';
            $data['certificate_path'] = $request->okta_certificate_file->storeAs($tenantFolder, $certificateName);
        }

        if ($request->okta_key_file) {
            $keyName          = 'key_file.key';
            $data['key_path'] = $request->okta_key_file->storeAs($tenantFolder, $keyName);
        }

        $tenant->ssoConfiguration()->updateOrCreate(
            ['tenant_id' => $tenant->id],
            $data
        );
    }

    public function storeAADInformations(Request $request, Tenant $tenant) {
        $tenantFolder = 'aad_information/' . $tenant->tenant_id;

        $data = [
            'autocreate_authenticated_users' => $request->input('aad_autocreate_authenticated_users', false),
            'login_url'                      => $request->aad_login_url,
            'issuer_url'                     => $request->aad_issuer_url,
            'logout_url'                     => $request->aad_logout_url,
            'sso_type'                       => Tenant::AUTH_SERVICE_AAD,
        ];

        if ($request->aad_certificate_file) {
            $certificateName          = 'certificate_file.cer';
            $data['certificate_path'] = $request->aad_certificate_file->storeAs($tenantFolder, $certificateName);
        }

        if ($request->aad_key_file) {
            $keyName          = 'key_file.key';
            $data['key_path'] = $request->aad_key_file->storeAs($tenantFolder, $keyName);
        }

        $tenant->ssoConfiguration()->updateOrCreate(
            ['tenant_id' => $tenant->id],
            $data
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tenant = Tenant::where(['tenant_id' => $id])->first();

        if (!is_null($tenant)) {
            if (user()->account_type == 1) {
                User::where('tenant_id', '=', $tenant->tenant_id)->update(['tenant_id' => null]);

                $tenant->delete();

                return redirect()->route('settings', tenant('tenant_id'))->with(
                    'success',
                    __('Tenant successfully deleted.')
                )->with('tab-status', 'tenant-layout');
            }

            return redirect()->route('settings', tenant('tenant_id'))->with(
                'error',
                __('Permission Denied.')
            )->with('tab-status', 'tenant-layout');
        }

        return redirect()->route('settings', tenant('tenant_id'))->with(
            'error',
            __('Permission Denied.')
        )->with('tab-status', 'tenant-layout');
    }

    // Validate while create Tenant
    public function validateTenant(Request $request) {
        $err = [];

        // Name Validation
        if (empty($request->name)) {
            $err['name'] = __('Name is required');
        }

        // Tenant Id Validation
        if (!empty($request->tenant_id)) {
            $tenantId = Tenant::where('tenant_id', 'LIKE', $request->tenant_id)->first();
            if (!empty($tenantId)) {
                $err['tenant_id'] = __('Tenant Id already exist in our records');
            } else {
                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $request->tenant_id)) {
                    $err['tenant_id'] = __('Invalid Tenant Id');
                }

                if ($request->tenant_id == trim($request->tenant_id) && strpos($request->tenant_id, ' ') !== false) {
                    $err['tenant_id'] = __('Invalid Tenant Id');
                }
            }
        } else {
            $err['tenant_id'] = __('Tenant Id is required');
        }
        // End Tenant Id Validation

        // Company Name Validation
        if (!empty($request->company_name)) {
            $companyName = Tenant::where('company_name', 'LIKE', $request->company_name)->first();
            if (!empty($companyName)) {
                $err['company_name'] = __('Company Name already exist in our records');
            }
        } else {
            $err['company_name'] = __('Company Name is required');
        }
        // End Company Name Validation

        // Company Phone Validation
        if (empty($request->company_phone)) {
            $err['company_phone'] = __('Company Phone is required');
        }
        // End Company Phone validation

        // Username Validation
        if (empty($request->username)) {
            $err['username'] = __('Username is required');
        }
        // end Username Validation

        // Password Validation
        if (!empty($request->password) && !empty($request->password_confirmation)) {
            if (strlen($request->password) < 8) {
                $err['password'] = __('Minimum 8 character required');
            } else {
                if (strcmp($request->password, $request->password_confirmation) != 0) {
                    $err['password'] = __('Password and Confirm password are not matched');
                }
            }
        } else {
            if (empty($request->password)) {
                $err['password'] = __('Password is required');
            }

            if (empty($request->password_confirmation)) {
                $err['password_confirmation'] = __('Confirm password is required');
            }
        }
        // End Password Validation

        // Email Validation
        if (!empty($request->email)) {
            $email = User::where('email', 'LIKE', $request->email)->first();
            if (!empty($email)) {
                $err['email'] = __('Email already exist in our records');
            }
        } else {
            $err['email'] = __('Email is required');
        }

        if (count($err) > 0) {
            return response()->json([
                'is_success' => false,
                'errors'     => $err,
            ]);
        }

        return response()->json(['is_success' => true]);
    }

    public function tenantException() {
        return view('errors.tenanat_exception');
    }

    private function validateStoreTenant(Request $request): MakeValidator {
        $rules = [
            'tenant_id'             => 'required|regex:/^[a-zA-Z0-9_\-]*$/|unique:tenants',
            'company_name'          => 'required|unique:tenants',
            'company_phone'         => 'required',
            'name'                  => 'required',
            'username'              => 'required|unique:users',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ];

        if ($request->authentication_service == Tenant::AUTH_SERVICE_OKTA) {
            $this->addOktaValidationRules($rules);

            return Validator::make($request->all(), $rules, [
                'okta_login_url.required'         => 'The Login url is required.',
                'okta_issuer_url.required'        => 'The Issuer url is required.',
                'okta_logout_url.required'        => 'The Logout url is required.',
                'okta_certificate_file.required'  => 'The Certificate File is required.',
                'okta_key_file.required'          => 'The Key File is required.',
                'okta_login_url.url'              => 'The Login url should be a url.',
                'okta_issuer_url.url'             => 'The Issuer url should be a url.',
                'okta_logout_url.url'             => 'The Logout url should be a url.',
                'okta_certificate_file.max'       => 'The max limit for the Certificate File is 2048kb.',
                'okta_key_file.max'               => 'The max limit for the Key File is 2048kb.',
                'okta_certificate_file.mimetypes' => 'The certificate file must be a valid file.',
                'okta_key_file.mimetypes'         => 'The key file must be a valid file.',
            ]);
        }

        if ($request->authentication_service == Tenant::AUTH_SERVICE_AAD) {
            $this->addAADValidationRules($rules);

            return Validator::make($request->all(), $rules, [
                'aad_login_url.required'         => 'The Login url is required.',
                'aad_issuer_url.required'        => 'The Issuer url is required.',
                'aad_logout_url.required'        => 'The Logout url is required.',
                'aad_certificate_file.required'  => 'The Certificate File is required.',
                'aad_key_file.required'          => 'The Key File is required.',
                'aad_login_url.url'              => 'The Login url should be a url.',
                'aad_issuer_url.required'        => 'The Azure Application ID is required.',
                'aad_logout_url.url'             => 'The Logout url should be a url.',
                'aad_certificate_file.max'       => 'The max limit for the Certificate File is 2048kb.',
                'aad_key_file.max'               => 'The max limit for the Key File is 2048kb.',
                'aad_certificate_file.mimetypes' => 'The certificate file must be a valid file.',
                'aad_key_file.mimetypes'         => 'The key file must be a valid file.',
            ]);
        }

        //ILINX authentication
        return Validator::make($request->all(), $rules);

    }

    private function validateUpdateTenant(Request $request, Tenant $tenant): MakeValidator {
        $rules = [
            'company_name'  => 'required',
            'company_phone' => 'required',
        ];

        if ($request->authentication_service == Tenant::AUTH_SERVICE_OKTA) {
            $this->addOktaValidationRules($rules);

            if ($tenant->authentication_service == $request->authentication_service) {
                if (!isset($request->okta_certificate_file)) {
                    unset($rules['okta_certificate_file']);
                }
                if (!isset($request->okta_key_file)) {
                    unset($rules['okta_key_file']);
                }
            }

            return Validator::make($request->all(), $rules, [
                'okta_login_url.required'         => 'The Login url is required.',
                'okta_issuer_url.required'        => 'The Issuer url is required.',
                'okta_logout_url.required'        => 'The Logout url is required.',
                'okta_certificate_file.required'  => 'The Certificate File is required.',
                'okta_key_file.required'          => 'The Key File is required.',
                'okta_login_url.url'              => 'The Login url should be a url.',
                'okta_issuer_url.url'             => 'The Issuer url should be a url.',
                'okta_logout_url.url'             => 'The Logout url should be a url.',
                'okta_certificate_file.max'       => 'The max limit for the Certificate File is 2048kb.',
                'okta_key_file.max'               => 'The max limit for the Key File is 2048kb.',
                'okta_certificate_file.mimetypes' => 'The certificate file must be a valid file.',
                'okta_key_file.mimetypes'         => 'The key file must be a valid file.',
            ]);
        }

        if ($request->authentication_service == Tenant::AUTH_SERVICE_AAD) {
            $this->addAADValidationRules($rules);

            if ($tenant->authentication_service == $request->authentication_service) {
                if (!isset($request->aad_certificate_file)) {
                    unset($rules['aad_certificate_file']);
                }
                if (!isset($request->aad_key_file)) {
                    unset($rules['aad_key_file']);
                }
            }

            return Validator::make($request->all(), $rules, [
                'aad_login_url.required'         => 'The Login url is required.',
                'aad_issuer_url.required'        => 'The Issuer url is required.',
                'aad_logout_url.required'        => 'The Logout url is required.',
                'aad_certificate_file.required'  => 'The Certificate File is required.',
                'aad_key_file.required'          => 'The Key File is required.',
                'aad_login_url.url'              => 'The Login url should be a url.',
                'aad_issuer_url.required'        => 'The Azure Application ID is required.',
                'aad_logout_url.url'             => 'The Logout url should be a url.',
                'aad_certificate_file.max'       => 'The max limit for the Certificate File is 2048kb.',
                'aad_key_file.max'               => 'The max limit for the Key File is 2048kb.',
                'aad_certificate_file.mimetypes' => 'The certificate file must be a valid file.',
                'aad_key_file.mimetypes'         => 'The key file must be a valid file.',
            ]);
        }

        return Validator::make($request->all(), $rules);

    }

    private function addOktaValidationRules(array&$rules): void {
        $rules += [
            'okta_login_url'        => ['required', 'url'],
            'okta_issuer_url'       => ['required', 'url'],
            'okta_logout_url'       => ['required', 'url'],
            'okta_certificate_file' => ['required', 'max:2048', 'mimetypes:text/plain'],
            'okta_key_file'         => ['required', 'max:2048', 'mimetypes:text/plain'],
        ];
    }

    private function addAADValidationRules(array&$rules): void {
        $rules += [
            'aad_login_url'        => ['required', 'url'],
            'aad_issuer_url'       => ['required'],
            'aad_logout_url'       => ['required', 'url'],
            'aad_certificate_file' => ['required', 'max:2048', 'mimetypes:text/plain'],
            'aad_key_file'         => ['required', 'max:2048', 'mimetypes:text/plain'],
        ];
    }

    private function logout(Request $request, $authType) {
        $usrData = Session::get('userInfo');

        if ($authType === Tenant::AUTH_SERVICE_OKTA) {
            Session::put('oldAuthService', Tenant::AUTH_SERVICE_OKTA);

            return (new SsoConfigurationAuthenticationService)->logout($usrData);
        }

        if ($authType === Tenant::AUTH_SERVICE_AAD) {
            Session::put('oldAuthService', Tenant::AUTH_SERVICE_AAD);

            return (new SsoConfigurationAuthenticationService)->logout($usrData);
        }

        $request->session()->invalidate();
        $this->loggedOut($request);

        return (new IlinxAuthenticationService)->logout($usrData);
    }
}
