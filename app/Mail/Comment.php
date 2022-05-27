<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Comment extends Mailable
{
    use Queueable, SerializesModels;

    public $detail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $detail)
    {
        $this->detail = $detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->detail['title'])
                    ->view('emails.notification');
    }
}
