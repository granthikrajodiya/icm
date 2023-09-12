<?php

namespace App\Http\Clients\Twilio;

class MockTwilioClient implements TwilioClientInterface
{
    public function sendMessage(string $from, string $to, string $body): object
    {
        return (object) [
            'account_sid'           => 'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            'api_version'           => '2010-04-01',
            'body'                  => 'Hi there',
            'date_created'          => 'Thu, 30 Jul 2015 20:12:31 +0000',
            'date_sent'             => 'Thu, 30 Jul 2015 20:12:33 +0000',
            'date_updated'          => 'Thu, 30 Jul 2015 20:12:33 +0000',
            'direction'             => 'outbound-api',
            'error_code'            => null,
            'error_message'         => null,
            'from'                  => '+15017122661',
            'messaging_service_sid' => 'MGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            'num_media'             => '0',
            'num_segments'          => '1',
            'price'                 => null,
            'price_unit'            => null,
            'sid'                   => 'SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            'status'                => 'sent',
            'subresource_uris'      => (object) [
                'media' => '/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Media.json'
            ],
            'to'  => '+15558675310',
            'uri' => '/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX.json',
        ];
    }
}