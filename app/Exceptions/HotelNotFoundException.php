<?php

namespace App\Exceptions;

use Exception;

class HotelNotFoundException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report(): ?bool
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     */
    public function render(): \Illuminate\Http\Response
    {
        return response()->view('Exception.hotel-not-found');
    }
}
