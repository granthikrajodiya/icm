<?php

namespace App\Http\Clients\Twilio;

use Exception;
use Throwable;

class TwilioClientException extends Exception
{
    public const CODE_SEND_MESSAGE = 1;

    public static function sendMessageFailure(string $to, Throwable $previous = null): static
    {
        return new self(
            sprintf('Failed to send message to number: %s.', $to), self::CODE_SEND_MESSAGE, $previous,
        );
    }
}