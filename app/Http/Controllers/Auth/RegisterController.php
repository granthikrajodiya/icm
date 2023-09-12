<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStoreRequest;
use App\Models\User;
use App\Models\Utility;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterStoreRequest $request)
    {
        // Create User
        $user = $this->create($request->validated());

        // Make API Call Here for Registration
        $post       = $request->all();
        $post['id'] = $user->id;

        $tenant = tenant();

        $post['tenant_id']    = $tenant->tenant_id;
        $post['company_name'] = $tenant->company_name;

        $post['tenant_contact_name']  = $tenant->user?->name;
        $post['tenant_contact_email'] = $tenant->user?->email;
        $post['send_invitation']      = 1;
        $post['account_type']         = $user->account_type;
        $apiResp                      = Utility::makeRegistration($post);

        if ($apiResp['is_success'] == true) {
            $message           = [];
            $message['header'] = config('message.register_message_header');
            $message['msg']    = config('message.register_message');
        } else {
            $message           = [];
            $message['header'] = __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.');
            $message['msg']    = $apiResp['msg'];

            $user->delete();
        }

        $tenantId = !empty(tenant('tenant_id')) ? tenant('tenant_id') : 'host';

        return view('auth.register_response', compact('message', 'tenantId'));
    }

    protected function create(array $data)
    {
        return User::create([
            'name'                   => $data['name'],
            'username'               => $data['username'],
            'email'                  => $data['email'],
            'password'               => Hash::make($data['password']),
            'created_by'             => 1,
            'account_type'           => tenant('tenant_id') === 'host' ? User::INTERNAL_TENANT_USER : User::EXTERNAL_TENANT_USER,
            'account_status'         => 'pending',
            'account_status_message' => config('message.register_message'),
            'tenant_id'              => tenant('tenant_id'),
        ]);
    }
}
