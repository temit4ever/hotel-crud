<?php

namespace App\Actions\Hotel;
use App\Exceptions\HotelNotFoundException;
use App\Interfaces\HotelRepositoryInterface;
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
        try {
            return [
                'hotelDetails' => $this->hotelRepository->getHotel($id),
            ];
        }
        catch (HotelNotFoundException $exception) {
            return view('Exception.hotel-not-found', ['error' => $exception->getMessage()]);
        }
    }

    public function asController(int $id)
    {
       return $this->handle($id);
    }

    public function jsonResponse(mixed $data)
    {
        return response()->json($data);
    }
}
