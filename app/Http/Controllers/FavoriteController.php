<?php

namespace App\Http\Controllers;

use App\Models\Coins;
use App\Models\Favorite;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $client = new CoinGeckoClient();
            $allCoins = $client->coins()->getMarkets('usd');
            $favorites = Favorite::where('idUser', '=', $user->id)->paginate(10);
            if ($favorites->isEmpty()) {
                return view('favorite.allfavorite')->with('favorites', $favorites)->with('allCoins', $allCoins)->with('error', 'No favorites');
            } else {
                return view('favorite.allfavorite')->with('favorites', $favorites)->with('allCoins', $allCoins);
            }
        }
    }
}
