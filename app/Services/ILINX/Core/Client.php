<?php

namespace App\Services\ILINX\Core;

use App\Exceptions\IlinxException;
use App\Services\ILINX\Middleware\PreventEmptyApiResponses;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Facades\Log;
use Session;

class Client
{
    private Guzzle $client;
    private HandlerStack $handler;
    protected array $userInfo;
    protected string $baseUri = '';

    public function __construct()
    {
        $this->userInfo = [
            'Username'      => session('userInfo.Username'),
            'SecurityToken' => session('userInfo.SecurityToken'),
        ];

        $this->handler = HandlerStack::create();
        $this->handler->push(new PreventEmptyApiResponses);

        $this->client = new Guzzle([
            'base_uri' => $this->baseUri ?: config('ilinx.ics_url'),
            'handler'  => $this->handler,
        ]);
    }

    public function getCredentials(): array
    {
        $userInfo = Session::get('userInfo');

        return [
            'Username'      => $userInfo->Username ?? "",
            'SecurityToken' => $userInfo->SecurityToken ?? "",
            'ActivationKey' => config('ilinx.activation_id'),
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
    }

    public function setBaseUrl(string $baseUri): static
    {
        $this->handler = HandlerStack::create();
        $this->handler->push(new PreventEmptyApiResponses);

        $this->baseUri = $baseUri;
        $this->client  = new Guzzle([
            'base_uri' => $baseUri,
            'handler'  => $this->handler,
        ]);

        return $this;
    }

    public function get(string $url, array $query = []): object
    {
        try {
            $options = [
                'query'   => $query,
                'headers' => $this->getCredentials(),
            ];
            $request = $this->client->request('GET', $url, $options);

        } catch (ClientException | GuzzleException $e) {
            if ($e->getResponse()->getReasonPhrase() === 'Security token has expired.') {
                return redirect()->route('logout', [tenant('tenant_id')])->send();
            }
            return $this->defaultResponse($options, $e->getMessage());
        }

        $return = (object)json_decode($request->getBody()->getContents());

        if (isset($return->Success) && $return->Success === false && $return->ErrorMessage === 'Security token has expired.') {
            return redirect()->route('logout', [tenant('tenant_id')])->send();
        }

        if($return && isset($return->Success)) {
            return $return;
        }

        return $this->defaultResponse($return);
    }

    public function post(string $url, array $data = []): object
    {
        $options = [
            'body'    => json_encode(array_merge($this->getCredentials(), $data)),
            'headers' => $this->getCredentials(),
        ];
        try {
            $request = $this->client->post($url, $options);
        } catch (ClientException | GuzzleException $e) {
            if ($e->getResponse()->getReasonPhrase() === 'Security token has expired.') {
                return redirect()->route('logout', [tenant('tenant_id')])->send();
            }
            return $this->defaultResponse($options, $e->getMessage());
        }

        $return = (object)json_decode($request->getBody()->getContents());

        if (isset($return->Success) && $return->Success === false && $return->ErrorMessage === 'Security token has expired.') {
            return redirect()->route('logout', [tenant('tenant_id')])->send();
        }

        // double-checking return value nust have Success
        if($return && isset($return->Success) && $return->Success) {
            return $return;
        }

        return $this->defaultResponse($return);
    }

    public function put(string $url, array $data = []): object
    {
        $options = [
            'body'    => json_encode($data),
            'headers' => $this->getCredentials(),
        ];
        try {
            $request = $this->client->put($url, $options);
        } catch (ClientException | GuzzleException $e) {
            if ($e->getResponse()->getReasonPhrase() === 'Security token has expired.') {
                return redirect()->route('logout', [tenant('tenant_id')])->send();
            }
            return $this->defaultResponse($options, $e->getMessage());
        }

        $return = (object)json_decode($request->getBody()->getContents());

        if (isset($return->Success) && $return->Success === false && $return->ErrorMessage === 'Security token has expired.') {
            return redirect()->route('logout', [tenant('tenant_id')])->send();
        }

        if($return && isset($return->Success)){ // checking if success is within the result
            return $return;
        }

        return $this->defaultResponse($return);
    }

    public function stream(string $url): string
    {
        $options = [
            'headers' => $this->getCredentials(),
        ];
        try {
            $request = $this->client->get($url, $options);
        } catch (ClientException | GuzzleException $e) {
            if ($e->getResponse()->getReasonPhrase() === 'Security token has expired.') {
                return redirect()->route('logout', [tenant('tenant_id')])->send();
            }
            return $this->defaultResponse($options, $e->getMessage());
        }

        $return = (object)json_decode($request->getBody()->getContents());

        if (isset($return->Success) && $return->Success === false && $return->ErrorMessage === 'Security token has expired.') {
            return redirect()->route('logout', [tenant('tenant_id')])->send();
        }

        if($return && isset($return->Success)){ // checking if success is within the result
            return $return;
        }

        return $this->defaultResponse($return);
    }

    private function defaultResponse($data, $error = ""): object
    {
        $data = (object)$data;
        Log::error('Client request data: ' . json_encode($data));
        $error = $data->ErrorMessage ?? $error;
        Log::error('Client response: ' . $error);
        return (object)[
            "Success" => false,
            "Data"    => $data,
            "ErrorMessage" => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.')
        ];
    }
}
