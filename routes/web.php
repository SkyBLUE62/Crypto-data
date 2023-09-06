<?php

use App\Http\Controllers\API\APIfavoriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Home Controller
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);

// Coin Controller
Route::get('/coin/{id}', [CoinController::class, 'show']);
Route::get('/allcoins', [CoinController::class, 'index']);
// Route::get('/insertCoins', [CoinController::class, 'insertCoins']);

// ExchangeController
Route::get('/exchange/all', [ExchangeController::class, 'index']);
// Route::get('/insertExchange', [ExchangeController::class, 'insertExchange']);

// ErrorController
Route::get('/error404', [ErrorController::class, 'error404']);
Route::get('/error429', [ErrorController::class, 'error429']);

//UserController
Route::get('/signup', [UserController::class, 'register_view']);
Route::get('/signin', [UserController::class, 'login_view'])->name('signin');
Route::post('/create_account', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

//UserController Google
Route::get('/login/google', [UserController::class, 'redirectToProvider']);
Route::get('/login/google/callback', [UserController::class, 'handleProviderCallback']);

// SearchController
Route::post('/search/redirect', [SearchController::class, 'search']);
Route::get("/search", [SearchController::class,'index']);

//Auth Verification
Route::middleware(['auth:sanctum'])->group(function () {
    //FavoriteController
    Route::get('/my-favorites', [FavoriteController::class, 'index']);
    //UserController
    Route::get('/logout', [UserController::class, 'logout']);
    //PortfolioController
    // Route::get('/portfolio', [PortfolioController::class, 'index']);
    // Route::post('/add-coin-wallet',[PortfolioController::class, 'add_coin_wallet']);
});
//

