<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HotelEditedConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private $hotel)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = auth()->user();
        return $this
            ->from('tems@test.com', 'Tems Admin')
            ->to('super-admin@test.com')
            ->subject('Admin ' . $user->name . ' updated item with id ' . $this->hotel->id)
            ->markdown('hotel-confirmation-mail.hotel-edit-confirmation', ['hotel' => $this->hotel]);
    }
}
