<?php

namespace App\Actions\Hotel;
use App\Events\AddHotel;
use App\Interfaces\HotelRepositoryInterface;
use App\Models\Hotel;
use Exception;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * Delete a record from the database
 */
class ProcessDeleteHotel
{
    use AsAction;
    public function __construct(protected HotelRepositoryInterface $hotelRepository)
    {

    }
    public function handle($id)
    {
        return $this->hotelRepository->deleteHotel($id);
    }

    public function asController($id)
    {
        return $this->handle($id);
    }

    public function jsonResponse($data)
    {
        response()->json($data);
    }

}
