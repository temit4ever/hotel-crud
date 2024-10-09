<?php

namespace App\Factory;

use Illuminate\Support\Facades\Log;
use Spatie\Geocoder\Exceptions\CouldNotGeocode;
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
        catch (CouldNotGeocode $exception) {
            Log::error($exception);
            throw new \Error($exception->getMessage());
        }
    }
}
