<?php

namespace Tests\Feature\Hotel;

use App\Models\Hotel;
use App\Models\User;
use App\Interfaces\HotelRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class HotelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    protected mixed $user;
    protected mixed $auth;
    protected mixed $hotel;
    protected  mixed $getReadableError;
    protected mixed $errorSession;

    public function setUp(): void
    {
        parent::setUp();
        $this->getReadableError = $this->withoutExceptionHandling();
        $this->errorSession = session('errors');
        $this->user = User::factory()->create();
        $this->auth = $this->actingAs($this->user);
        $this->hotel = Hotel::factory()->create();
        Storage::fake('public/testing');


    }

    /**
     * Capture test for creating records in the hotel database
     *
     * @return void
     */
    public function test_can_create_hotel(): void
    {
        $this->auth
            ->call(
            'POST',
            route('hotel.store'),
            [
                'hotelName' => $this->faker->title,
                'hotelCity' => $this->faker->city,
                'hotelAddress' => $this->faker->streetAddress,
                'hotelDescription' => $this->faker->text,
                'hotelStar' => '5',
                'hotelImage' => UploadedFile::fake()->image('photo.png')
            ]
        )
            ->assertStatus(200)
            ->assertSessionHasNoErrors();

    }

    /**
     * Capture test for updating records in the hotel database
     *
     * @return void
     */
    public function test_can_update_hotel(): void
    {
        $this->auth
            ->call(
                'PATCH',
                route('hotel.update', $this->hotel->id),
                [
                    'hotelName' => 'Hotel Royal',
                    'hotelCity' => $this->faker->city,
                    'hotelAddress' => $this->faker->streetAddress,
                    'hotelDescription' => $this->faker->text,
                    'hotelStar' => '4',
                    'hotelImage' => UploadedFile::fake()->image('photo.png')
                ]
            )
            ->assertStatus(200)
            ->assertSessionHasNoErrors();
    }

    /**
     * Capture test for showing all records in the hotel database
     *
     * @return void
     */
    public function test_can_view_all_hotel(): void
    {
        $this->auth
            ->call('GET', route('hotel.index'))
            ->assertStatus(200)
            ->assertSessionHasNoErrors();

    }

    /**
     * Capture test for showing specific records in the hotel database
     *
     * @return void
     */
    public function test_can_show_specific_hotel(): void
    {
        $this->auth
            ->call('GET', route('hotel.show', $this->hotel->id))
            ->assertStatus(200)
            ->assertSessionHasNoErrors();
    }

    /**
     * Capture test for deleting specific records in the hotel database
     *
     * @return void
     */
    public function test_can_delete_specific_hotel(): void
    {
        $this->auth
            ->call('DELETE', route('hotel.delete', $this->hotel->id))
            ->assertStatus(200)
            ->assertJson([ 'message' => 'Hotel has been deleted successfully'])
            ->assertSessionHasNoErrors();;

    }


}
