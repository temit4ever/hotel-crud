<?php

namespace App\Listeners;

use App\Mail\HotelEditedConfirmation;
use Illuminate\Support\Facades\Mail;


class HotelEditedListener
{
    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event): void
    {
        Mail::send(new HotelEditedConfirmation($event->hotel));
    }
}
