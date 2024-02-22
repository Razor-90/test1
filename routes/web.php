<?php

use App\Http\Controllers\Admin\PromoCodeController;
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

Route::get('/', function () {
    return view('user.welcome');
});

Route::post('/user/check-promo-code', 'PromoCodeController@checkPromoCode')->name('user.checkPromoCode');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/cabinet', 'UserController@showCabinet')->name('user.cabinet');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {

    Route::get('/users', 'Admin\UserController@index')->name('admin.users.index');
    // List promo codes
    Route::get('/promo_codes', 'Admin\PromoCodeController@index')->name('admin.promo_codes.index');
    Route::post('/promo_codes', 'Admin\PromoCodeController@store')->name('admin.promo_codes.store');
    Route::post('/promo-codes/upload', 'Admin\PromoCodeController@uploadCSV')->name('promo_codes.upload');
    Route::get('/promo_codes/export', 'Admin\PromoCodeController@exportCSV')->name('promo_codes.export.form');

    Route::get('/export-promo-codes', 'PromoCodeController@export')->name('promo_codes.export');
    // routes/web.php
Route::post('/update-prize-received', 'PromoCodeController@updatePrizeReceived')->name('update.prize.received');
Route::get('/export-activated-promo-codes', 'PromoCodeController@exportActivatedPromoCodes')->name('promo_codes.export');



});

