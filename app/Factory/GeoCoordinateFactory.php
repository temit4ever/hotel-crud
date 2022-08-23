<?php

namespace App\Factory;

use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\Geocoder\Facades\Geocoder;

class GeoCoordinateFactory
{
    public function __construct(private string $address)
    {
    }

    public function getCoordinate()
    {
        try {
            return Geocoder::getCoordinatesForAddress($this->address);
        }
        catch (Exception $exception) {
            Log::error($exception);
        }
    }
}
