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
    public  function handle(?int $id)
    {
        try {
            return [
                'hotelDetails' => $this->hotelRepository?->getHotel($id),
            ];
        }
        catch (HotelNotFoundException $exception) {
            // Use the below if you are expecting to display error on page
            /*return view('Exception.hotel-not-found', ['error' => $exception->getMessage()]);*/

            // Use this if there isn't any view to display the error.
            return $exception->getMessage();
        }
    }

    public function asController(?int $id)
    {
       return $this->handle($id);
    }

    public function jsonResponse(? array $data): \Illuminate\Http\JsonResponse
    {
        return response()->json($data);
    }
}
