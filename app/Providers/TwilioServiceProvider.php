<?php

namespace App\Providers;

use App\Http\Clients\Twilio\LiveTwilioClient;
use App\Http\Clients\Twilio\MockTwilioClient;
use App\Http\Clients\Twilio\TwilioClientInterface;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TwilioServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(TwilioClientInterface::class, function (Application $app): TwilioClientInterface {
            if ($app->runningUnitTests()) {
                return new MockTwilioClient;
            }

            $authorization = base64_encode(
                sprintf('%s:%s', config('services.twilio.account_sid'), config('services.twilio.auth_token'))
            );

            return new LiveTwilioClient(
                new Client([
                    'base_uri' => config('services.twilio.base_uri'),
                    'headers' => [
                        'Authorization' => sprintf('Basic %s', $authorization)
                    ],
                ]),
                config('services.twilio.account_sid'),
            );
        });
    }

    public function provides()
    {
        return [TwilioClientInterface::class];
    }
}
