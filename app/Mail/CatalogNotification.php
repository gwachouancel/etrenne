<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Catalog;

class CatalogNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $catalog;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Catalog $catalog)
    {
        //
        $this->catalog = $catalog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notification / Message')->view('emails.catalog_notification');
    }
}
