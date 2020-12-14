<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class EmailEventChanged extends Mailable
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
            'name'     => $this->mailData['user_name'],
            'event_name'     => $this->mailData['event_name'],
            'start_date'     => $this->mailData['start_date'],
            'end_date'     => $this->mailData['end_date'],
            'event_place'     => $this->mailData['event_place'],
            'max_percipient'     => $this->mailData['max_percipient'],
            'event_type'     => $this->mailData['event_type'],
            'fakulta'     => $this->mailData['fakulta'],
            'katedra'     => $this->mailData['katedra'],
        );

        return $this->from('scheduletap@info.com', 'ScheduleTap')
            ->subject('Informácia o zmene')
            ->markdown('mails.eventemailchanged')
            ->with([
                'inputs' => $input
            ]);
    }
}
