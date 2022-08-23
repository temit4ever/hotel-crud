<?php

namespace App\Repositories;

use App\Interfaces\HotelRepositoryInterface;
use App\Models\Hotel;
use Exception;
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
     */
    public function getHotel($id = null): object
    {
        try {
            return Hotel::findOrFail($id);
        }
        catch (Exception $e) {
            Log::error($e);
        }
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
