<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class HotelEditedConfirmation extends Mailable implements ShouldQueue
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
    public function build(): static
    {
        return $this
            ->from(config('mail.from.address'), 'Tems Admin')
            ->to(config('mail.to.address'))
            ->subject('Admin ' . 'updated item with id ' . $this->hotel->id)
            ->markdown('hotel-confirmation-mail.hotel-edit-confirmation', ['hotel' => $this->hotel]);
    }
}
