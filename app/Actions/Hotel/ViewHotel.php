<?php

namespace App\Actions\Hotel;
use App\Interfaces\HotelRepositoryInterface;
use App\Models\Hotel;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * Get record from the hotel database based on a specific id
 */
class ViewHotel
{
    use AsAction;
    public function __construct(protected HotelRepositoryInterface $hotelRepository)
    {

    }
    public  function handle(int $id)
    {
        return [
            'hotelDetails' => $this->hotelRepository->getHotel($id),
        ];
    }

    public function asController(int $id)
    {
       return $this->handle($id);
    }

    public function jsonResponse(array $data)
    {
        return response()->json($data);
    }
}
