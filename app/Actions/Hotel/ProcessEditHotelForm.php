<?php

namespace App\Actions\Hotel;

use App\Events\HotelEdited;
use App\Exceptions\HotelNotFoundException;
use App\GeoLocation\Coordinates;
use App\ValidationRules\HotelValidationRules;
use App\Models\Hotel;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;


/**
 * Update a record from the Hotel database based on a specific id
 */
class ProcessEditHotelForm
{
    use AsAction;
    use HotelValidationRules;


    public function handle(ActionRequest $request, $id)
    {
        $data = $request->validated();
        $hotelData = Hotel::find($id);
        $fileName = $hotelData->image;
        $cord = Coordinates::create($data['hotelAddress'])->getCoordinate();

        try {
            if (!empty($hotelData)) {
                if ($request->hasFile('hotelImage')) {
                    if ($fileName) {
                        $getDirectoryPath = public_path("storage/images/hotels/{$id}");
                        $directoryExists = File::exists($getDirectoryPath);
                        if ($directoryExists) {
                            File::deleteDirectory($getDirectoryPath);
                        }
                    }

                    $fileName = $data['hotelImage']->hashName();;
                    Storage::disk('public')->putFileAs("images/hotels/$id", $data['hotelImage'], $fileName);
                }

                $hotelData->update([
                    'hotel_name' => $data['hotelName'],
                    'city' => $data['hotelCity'],
                    'address' => $data['hotelAddress'],
                    'description' => $data['hotelDescription'],
                    'stars' => $data['hotelStar'],
                    'image' => asset("storage/images/hotels/{$id}/{$fileName}"),
                    'longitude' => $cord['lat'],
                    'latitude' => $cord['lng'],
                ]);
            }

            // Dispatch event
            HotelEdited::dispatch($hotelData);
            return ['message' => 'Hotel details updated successfully'];

        } catch (Exception $exception) {
            Log::error($exception);
        }
        catch (HotelNotFoundException $exception) {
            return view('Exception.hotel-not-found', ['error' => $exception->getMessage()]);

        }
    }

    public function asController(ActionRequest $request, $id)
    {
        return $this->handle($request, $id);
    }

    public function jsonResponse($data)
    {
        response()->json($data);
    }
}
