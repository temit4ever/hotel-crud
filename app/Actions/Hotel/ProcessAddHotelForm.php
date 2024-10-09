<?php

namespace App\Actions\Hotel;
use App\Events\AddHotel;
use App\GeoLocation\Coordinates;
use App\ValidationRules\HotelValidationRules;
use App\Models\Hotel;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Geocoder\Exceptions\CouldNotGeocode;

/**
 * Add record to the Hotel database
 */
class ProcessAddHotelForm
{

    use AsAction;
    use HotelValidationRules;

    public function handle(ActionRequest $request)
    {
        $data = $request->validated();
        $imageName = 'default.jpeg';
        $cord = Coordinates::create($request->hotelAddress)->getCoordinate();
        try {
            $hotel = Hotel::create([
                'hotel_name' => $data['hotelName'],
                'city' => $data['hotelCity'],
                'address' => $data['hotelAddress'],
                'description' => $data['hotelDescription'],
                'stars' => $data['hotelStar'],
                'image' => $imageName,
                'longitude' => $cord['lat'],
                'latitude' => $cord['lng'],
            ]);

            $fileName = $data['hotelImage']->hashName();
            Storage::disk('public')->putFileAs("images/hotels/$hotel->id", $data['hotelImage'], $fileName);
            $hotel->image = asset("storage/images/hotels/{$hotel->id}/{$fileName}");
            $hotel->save();

            // Dispatch the add hotel event after creating record.
            AddHotel::dispatch($hotel);
            return ['message' => 'New hotel created'];

        } catch (Exception $exception) {
            Log::error($exception);
        }
    }

    public function asController(ActionRequest $request)
    {
        return $this->handle($request);
    }

    public function jsonResponse($data)
    {
        return response()->json($data);
    }
}
