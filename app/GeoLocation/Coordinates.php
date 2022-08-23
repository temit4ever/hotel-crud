<?php

namespace App\GeoLocation;

use App\Factory\GeoCoordinateFactory;

class Coordinates
{
    public static function create($address): GeoCoordinateFactory
    {
        return new GeoCoordinateFactory($address);
    }
}
