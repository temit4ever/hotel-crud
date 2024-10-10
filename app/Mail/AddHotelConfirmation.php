<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddHotelConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private $hotel)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this
            ->from(config('mail.from.address'))
            ->to(config('mail.to.address'))
            ->subject('Admin added item with id ' . $this->hotel->id)
            ->markdown('hotel-confirmation-mail.hotel-add-confirmation',
                [
                    'hotel' => $this->hotel
                ]);
    }
}
