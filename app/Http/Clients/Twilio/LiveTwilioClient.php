<?php

namespace App\Http\Clients\Twilio;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class LiveTwilioClient implements TwilioClientInterface
{
    public function __construct(
        private Client $client,
        private string $accountSid,
    )
    {
    }

    public function sendMessage(string $from, string $to, string $body): object
    {
        try {
            $response = $this->client->post("2010-04-01/Accounts/$this->accountSid/Messages.json", [
                'form_params' => [
                    'From' => $from,
                    'To'   => $to,
                    'Body' => $body,
                ],
            ]);
        } catch (GuzzleException $exception) {
            throw TwilioClientException::sendMessageFailure($to, $exception);
        }
        
        try {
            $parsedResponse = json_decode(
                $response->getBody()->getContents(), flags: JSON_THROW_ON_ERROR
            );
        } catch (JsonException $exception) {
            throw TwilioClientException::sendMessageFailure($to, $exception);
        }

        return $parsedResponse;
    }
}