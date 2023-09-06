
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ChartCoinController;
use App\Http\Controllers\API\APIfavoriteController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API chartController
Route::get("/chart/{id}", [ChartCoinController::class,'show']);
// API SearchController

Route::middleware(['auth:sanctum'])->group(function () {
    //API favoriteController
    Route::get("/addToFavorite/{id}", [APIfavoriteController::class, 'addToFavorite']);
    Route::get("/deleteFavorite/{id}", [APIfavoriteController::class, 'deleteFavorite']);
});

