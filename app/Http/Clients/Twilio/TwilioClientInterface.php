<?php

namespace App\Http\Clients\Twilio;

interface TwilioClientInterface
{
    /** Sends a text message. */
    public function sendMessage(string $from, string $to, string $body): object;
}