<?php

namespace App\Services\Authentication;

use App\Facades\ILINX;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use LightSaml\Binding\BindingFactory;
use LightSaml\Context\Profile\MessageContext;
use LightSaml\Credential\KeyHelper;
use LightSaml\Credential\X509Certificate;
use LightSaml\Helper;
use LightSaml\Model\Assertion\Issuer;
use LightSaml\Model\Assertion\NameID;
use LightSaml\Model\Protocol\AuthnRequest;
use LightSaml\Model\Protocol\LogoutRequest;
use LightSaml\Model\XmlDSig\SignatureWriter;
use LightSaml\SamlConstants;
use RuntimeException;

class SsoConfigurationAuthenticationService implements AuthenticationInterface
{
    public function login(string $username, string $password): RuntimeException
    {
        throw new RuntimeException('This service does not contain login');
    }

    public function logout(?object $usrData): bool | string
    {
        $certificateUrl = Storage::disk(env('FILESYSTEM_DRIVER'))->path(tenant()->ssoConfiguration?->certificate_path);
        $keyUrl         = Storage::disk(env('FILESYSTEM_DRIVER'))->path(tenant()->ssoConfiguration?->key_path);

        $certificate = X509Certificate::fromFile($certificateUrl);
        $privateKey  = KeyHelper::createPrivateKey($keyUrl, '', true);

        $issuer = " ";
        if(tenant()->ssoConfiguration?->sso_type == "sso_aad"){
            $issuer = tenant()->ssoConfiguration?->issuer_url;
        }

        if(tenant()->ssoConfiguration?->sso_type == "sso_okta"){
            $issuer = "Okta";
        }

        $authnRequest = new LogoutRequest();
        $authnRequest->setDestination(tenant()->ssoConfiguration?->logout_url)
            ->setIssuer(new Issuer($issuer))
            ->setID(Helper::generateID())
            ->setNameID(new NameID($usrData->Username ?? "host"))
            ->setIssueInstant(new \DateTime())
            ->setSignature(new SignatureWriter($certificate, $privateKey));

        $bindingFactory = new BindingFactory();
        $postBinding    = $bindingFactory->create(SamlConstants::BINDING_SAML2_HTTP_POST);

        $messageContext = new MessageContext();
        $messageContext->setBindingType(SamlConstants::BINDING_SAML2_HTTP_POST);
        $messageContext->setMessage($authnRequest);

        $httpResponse = $postBinding->send($messageContext);

        return $httpResponse->getContent();
    }

    public function handleLoginCallback(Request $request): RedirectResponse
    {
        $response = ILINX::auth()->validateSamlToken($request->get('SAMLResponse'));

        if (!$response->Success) {
            return redirect()->route('home', tenant('tenant_id'))
                ->withErrors(['error' => $response->ErrorMessage]);
        }
        Session::put('userInfo', $response->Data);

        if (tenant()->ssoConfiguration?->autocreate_authenticated_users == false) {
            $user = User::where(['email' => $response->Data->EmailAddress])->first();
            if (empty($user)) {
                return redirect()->route('make.logout', [
                    'tenant'  => tenant('tenant_id'),
                    'message' => 'This user is not registered in the system!'
                ]);
            }
        } else {
            $user = User::query()->updateOrCreate([
                'email' => $response->Data->EmailAddress,
            ], [
                "email"          => $response->Data->EmailAddress,
                "username"       => $response->Data->Username,
                "name"           => $response->Data->FullName,
                "password"       => "",
                "account_status" => 'active',
                "account_type"   => $this->getAccountType(
                    $response->Data,
                    tenant('tenant_id')
                )
            ]);
        }

        \Auth::login($user);

        return redirect()->route('home', tenant('tenant_id'));
    }

    public function getLoginUrl(): string
    {
        $authnRequest = new AuthnRequest();
        $authnRequest
            ->setAssertionConsumerServiceURL(route('login', tenant('tenant_id')))
            ->setProtocolBinding(SamlConstants::BINDING_SAML2_HTTP_POST)
            ->setID(Helper::generateID())
            ->setIssueInstant(new \DateTime())
            ->setDestination(tenant()->ssoConfiguration?->login_url)
            ->setIssuer(new Issuer(tenant()->ssoConfiguration?->issuer_url));

        $bindingFactory  = new BindingFactory();
        $redirectBinding = $bindingFactory->create(SamlConstants::BINDING_SAML2_HTTP_REDIRECT);

        $messageContext = new MessageContext();
        $messageContext->setMessage($authnRequest);

        /** @var RedirectResponse $httpResponse */
        $httpResponse = $redirectBinding->send($messageContext);

        return $httpResponse->getTargetUrl();
    }

    private static function getAccountType(?object $usrData, $tenantId):int
    {
        if ($tenantId === 'host') {
            if ($usrData->IsAdmin) {
                return User::INTERNAL_TENANT_ADMIN;
            }

            return User::INTERNAL_TENANT_USER;
        } else { // If the tenant is not host the system will check the security group on the env
            // Explode data from .env HOST_ADMIN_SECURITY_GROUP
            $securityGroup = explode(', ', env('HOST_ADMIN_SECURITY_GROUP'));
            // Check data from .env HOST_ADMIN_SECURITY_GROUP and the UserGroups array if there is matching records found
            $checkUserGroup = array_intersect($securityGroup, $usrData->UserGroups);

            if (count($checkUserGroup) > 0) {
                return User::INTERNAL_TENANT_ADMIN;
            } else {
                return User::INTERNAL_TENANT_USER;
            }
        }

        if ($isAdmin) {
            return User::EXTERNAL_TENANT_ADMIN;
        }

        return User::EXTERNAL_TENANT_USER;
    }
}
