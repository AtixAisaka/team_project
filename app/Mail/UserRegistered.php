<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $input = array(
            'name'     => $this->mailData['name'],
        );

        return $this->from('scheduletap@info.com', 'ScheduleTap')
            ->subject('Registrácia')
            ->markdown('mails.userregistered')
            ->with([
                'inputs' => $input
            ]);
    }
}
