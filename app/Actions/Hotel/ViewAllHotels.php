<?php

namespace App\Actions\Hotel;
use App\Interfaces\HotelRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;


/**
 * Get all record from the Hotel database
 */
class ViewAllHotels
{
    use AsAction;

    public function __construct(protected HotelRepositoryInterface $hotelRepository){}

    public function handle(): ?array
    {
        try {
            return ['hotels' => $this->hotelRepository?->getHotels()];
        }
        catch (Exception $e) {
            Log::error($e);
        }
    }

    public function jsonResponse(?array $data): \Illuminate\Http\JsonResponse
    {
        return response()->json($data);
    }
}
