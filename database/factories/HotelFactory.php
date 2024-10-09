<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        Storage::fake('public/testing');

        return [
            'hotel_name' => $this->faker->title,
            'city' => $this->faker->city,
            'address' => $this->faker->streetAddress,
            'description' => $this->faker->text,
            'stars' => rand(1, 5),
            'image' => $this->faker->imageUrl,
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
        ];
    }
}
