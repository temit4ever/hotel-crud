<?php

namespace App\Interfaces;

interface HotelRepositoryInterface
{
    public function getHotels();
    public function getHotel(int $id);
    public function deleteHotel(int $id);
}
