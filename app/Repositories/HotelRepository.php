<?php

namespace App\Repositories;

use App\Exceptions\HotelNotFoundException;
use App\Interfaces\HotelRepositoryInterface;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
class HotelRepository implements HotelRepositoryInterface
{
    /**
     * Get all hotel records
     *
     * @return object|null
     */
    public function getHotels(): ?object
    {
        return Hotel::all()->sortBy(SORT_DESC);
    }

    /**
     * Get a specific hotel record
     * @param int|null $id
     * @return object|null
     * @throws HotelNotFoundException
     */
    public function getHotel(?int $id): ?object
    {
        $result = Hotel::find($id);
        if (is_null($result)) {
            throw new HotelNotFoundException("The Hotel with id $id was not found");
        }
        return $result;
    }

    /**
     * Delete hotel specific record
     *
     * @param int|null $id
     * @return string[]
     */
    public function deleteHotel(?int $id)
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
}
