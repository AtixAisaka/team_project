<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class EmailEventInfo extends Mailable
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
            'event_name'     => $this->mailData['event_name'],
            'start_date'     => $this->mailData['start_date'],
            'end_date'     => $this->mailData['end_date'],
            'event_place'     => $this->mailData['event_place'],
        );

        return $this->from('scheduletap@info.com', 'ScheduleTap')
            ->subject('Informácie o evente')
            ->markdown('mails.eventemail')
            ->with([
                'name' => Auth::user()->name,
                'inputs' => $input
            ]);
    }
}
