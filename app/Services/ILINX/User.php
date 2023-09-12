<?php

namespace App\Services\ILINX;

use App\Services\ILINX\Core\Client;
use Exception;
use Illuminate\Support\Facades\Session;

class User extends Client
{
    /**
     * @throws Exception
     */
    public function store(array $data, string $securityToken, $batchProfileId): object
    {
        $this->setBaseUrl(config('ilinx.ic_url'));

        return $this->post('create-eform-batch', [
            "UserName"       => config('ilinx.registration_user.username'),
            "SecurityToken"  => $securityToken,
            "BatchProfileID" => $batchProfileId,
            "Indexes"        => [
                [
                    "IndexName"  => "[Batch name]",
                    "IndexValue" => "ICM new user registration",
                ],
                [
                    "IndexName"  => "Full Name",
                    "IndexValue" => $data['name'],
                ],
                [
                    "IndexName"  => "Username",
                    "IndexValue" => $data['username'],
                ],
                [
                    "IndexName"  => "Password",
                    "IndexValue" => $data['password'],
                ],
                [
                    "IndexName"  => "Email",
                    "IndexValue" => $data['email'],
                ],
                [
                    "IndexName"  => "UserId",
                    "IndexValue" => $data['id'],
                ],
                [
                    "IndexName"  => "AccountType",
                    "IndexValue" => $data["account_type"],
                ],
                [
                    "IndexName"  => "TenantId",
                    "IndexValue" => $data['tenant_id'] ?? '',
                ],
                [
                    "IndexName"  => "Tenant Name",
                    "IndexValue" => $data['company_name'] ?? '',
                ],
                [
                    "IndexName"  => "Tenant Contact Name",
                    "IndexValue" => $data['tenant_contact_name'] ?? '',
                ],
                [
                    "IndexName"  => "Tenant Contact Email",
                    "IndexValue" => $data['tenant_contact_email'] ?? '',
                ],
                [
                    "IndexName"  => "Send Invitation",
                    "IndexValue" => isset($data['send_invitation']) ? 1 : '',
                ],
            ],
        ]);
    }

    /**
     * @throws Exception
     */
    public function update(object $data): object
    {
        $userInfo = session('userInfo');

        return $this->post('update-builtin-user', [
            "UserName"      => $userInfo?->Username ?: '',
            "SecurityToken" => $userInfo?->SecurityToken ?: '',
            "OldPassword"   => $data->old_password ?: '',
            "NewPassword"   => $data->new_password ?: '',
            "Email"         => null,
            "FullName"      => null,
        ]);
    }

    /**
     * @throws Exception
     */
    public function passwordReset($data): object
    {
        return $this->post('reset-builtin-user-password', $data);
    }

    public function storeWithIndex($indexes = [], $securityToken, $batchProfileId)
    {
        $this->setBaseUrl(config('ilinx.ic_url'));

        return $this->post('create-eform-batch', [
            "UserName"       => config('ilinx.registration_user.username'),
            "SecurityToken"  => $securityToken,
            "BatchProfileID" => $batchProfileId,
            "Indexes"        => $indexes
        ]);
    }
}
