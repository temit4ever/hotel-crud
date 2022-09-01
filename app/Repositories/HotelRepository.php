<?php

namespace App\Repositories;

use App\Exceptions\HotelNotFoundException;
use App\Interfaces\HotelRepositoryInterface;
use App\Models\Hotel;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class HotelRepository implements HotelRepositoryInterface
{

    /**
     * Get all hotel records
     *
     * @return object
     */
    public function getHotels(): object
    {
        try {
            return Hotel::all();
        }
        catch (Exception $e) {
            Log::error($e);
        }
    }

    /**
     * Get a specific hotel record
     * @param $id
     * @return object
     * @throws HotelNotFoundException
     */
    public function getHotel($id = null): object
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            throw new HotelNotFoundException("The Hotel with id $id was nt found");
        }

        return $hotel;
    }

    /**
     * Delete hotel specific record
     *
     * @param $id
     * @return string[]|void
     */
    public function deleteHotel($id = null)
    {
        try
        {
            $hotel = Hotel::findOrFail($id)->delete();

            // Do some little clean up after an item has been deleted,
            // by deleting the image folder of that item.
            if ($hotel) {
                $getDirectoryPath = public_path("storage/images/hotels/{$id}");
                $directoryExists = File::exists($getDirectoryPath);
                if ($directoryExists) {
                    File::deleteDirectory($getDirectoryPath);
                }
            }

            return [
                'message' => 'Hotel has been deleted successfully'
            ];
        }
        catch (Exception $exception)
        {
            Log::error($exception);
        }
    }
}
