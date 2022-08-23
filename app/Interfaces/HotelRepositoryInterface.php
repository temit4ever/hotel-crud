<?php

namespace App\Interfaces;

interface HotelRepositoryInterface
{
    public function getHotels();
    public function getHotel($id);
    public function deleteHotel($id);



}
