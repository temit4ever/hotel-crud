<?php

namespace App\Actions\Hotel;
use App\Interfaces\HotelRepositoryInterface;
use App\Repositories\HotelRepository;
use Lorisleiva\Actions\Concerns\AsAction;


/**
 * Get all record from the Hotel database
 */
class ViewAllHotels
{
    use AsAction;

    public function __construct(protected HotelRepositoryInterface $hotelRepository)
    {

    }
    public function handle()
    {
        return ['hotels' => $this->hotelRepository->getHotels()];
    }

    public function jsonResponse(array $data)
    {
        return response()->json($data);
    }
}
