<?php

namespace App\Services\ILINX;

use App\Services\ILINX\Core\Client;
use Exception;

class Auth extends Client
{
    /**
     * @throws Exception
     */
    public function login(string $username, string $password): object
    {
        return $this->post('login', [
            "UserName"     => $username,
            "Password"     => $password,
            "Host"         => "ILINX Case Management",
            "IpAddress"    => getHostByName(getHostName()),
            "ActivationID" => config('ilinx.activation_id'),
        ]);
    }

    /**
     * @throws Exception
     */
    public function logout(string $username): object
    {
        return $this->post('logout', [
            "UserName" => $username,
            "Host"     => "ILINX Case Management",
        ]);
    }

    public function validateSamlToken($samlResponse): object
    {
		$samldata = [
            'SecurityToken' => $samlResponse,
            'ValidateCert' => false,
            'EnableTracking' => true,
            'HostName' => getHostByName(getHostName()),
			'CallingAppName' => 'ILINX Engage'
        ];
		$dataString = json_encode($samldata);

        $endpoint = config('ilinx.ics_url') . '/validate-saml2-token';
        $curl     = curl_init();

        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dataString),
        ]);
        $data     = curl_exec($curl);
        $response = json_decode($data);

        curl_close($curl);

        return $response;
    }
}
