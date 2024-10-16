<?php

use App\Actions\Hotel\ProcessAddHotelForm;
use App\Actions\Hotel\ProcessDeleteHotel;
use App\Actions\Hotel\ProcessEditHotelForm;
use App\Actions\Hotel\ViewAllHotels;
use App\Actions\Hotel\ViewHotel;
use App\Events\HotelEdited;
use App\Http\Controllers\HomeController;
use App\Models\Hotel;
use App\PatternTypes\Factory\BookFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    phpinfo();
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::get('pattern-types/factory', BookFactory::class);


Route::group([
    'middleware' => ['auth'],
    'prefix' => 'home'
], function () {
    Route::post('add-hotel', ProcessAddHotelForm::class)->name('hotel.store');
    Route::patch('edit-hotel/{id}', ProcessEditHotelForm::class)->name('hotel.update');
    Route::delete('delete-hotel/{id}', ProcessDeleteHotel::class)->name('hotel.delete');
    Route::get('view-hotel/{id}', ViewHotel::class)->name('hotel.show');
    Route::get('hotel-lists', ViewAllHotels::class)->name('hotel.index');
});
