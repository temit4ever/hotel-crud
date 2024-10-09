<?php

namespace App\Listeners;

use App\Mail\AddHotelConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AddHotelListener
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(object $event): void
    {
        Mail::send(new AddHotelConfirmation($event->hotel));
    }
}
