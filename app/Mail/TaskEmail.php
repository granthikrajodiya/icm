<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $taskEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($taskEmail)
    {
        $this->taskEmail = $taskEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('email.from.address'), config('email.from.name'))
            ->markdown('email.task_email')
            ->subject($this->taskEmail->subject)
            ->with([
                'taskEmail' => $this->taskEmail,
            ]);
    }
}
