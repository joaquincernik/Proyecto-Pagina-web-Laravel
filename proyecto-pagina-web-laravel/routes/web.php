<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneRssController;
use App\Http\Controllers\PharmacyRssController;
use App\Http\Controllers\MuniRssController;
use App\Http\Controllers\TaxyRssController;
use App\Http\Controllers\SocialesRssController;
use App\Http\Controllers\InfocoopRssController;
use App\Http\Controllers\MeteoRssController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/phone/service', [PhoneRssController::class, 'generateRssFeed']);
Route::get('/pharmacy/service', [PharmacyRssController::class, 'generateRssFeed']);
Route::get('/muni/service', [MuniRssController::class, 'generateRssFeed']);
Route::get('/taxy/service', [TaxyRssController::class, 'generateRssFeed']);
Route::get('/sociales/service', [SocialesRssController::class, 'generateRssFeed']);
Route::get('/infocoop/service', [InfocoopRssController::class, 'generateRssFeed']);
Route::get('/meteoomx/service', [MeteoRssController::class, 'generateRssFeed']);
