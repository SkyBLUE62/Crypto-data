<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $client = new CoinGeckoClient();
            $topCoin = [
                'bitcoin' => $client->coins()->getCoin('bitcoin', ['tickers' => 'true', 'market_data' => 'true']),
                'ethereum' => $client->coins()->getCoin('ethereum', ['tickers' => 'false', 'market_data' => 'true']),
                'cosmos' => $client->coins()->getCoin('cosmos', ['tickers' => 'false', 'market_data' => 'true']),
                'litecoin' => $client->coins()->getCoin('litecoin', ['tickers' => 'false', 'market_data' => 'true']),
            ];
            $allCoin = $client->coins()->getMarkets('usd');
            $user = Auth::user();

            if ($user) {
                $userFavorites = Favorite::where('idUser', $user['id'])->get();
                return view('home.home')->with('allCoin', $allCoin)->with('topCoin', $topCoin)->with('userFavorites', $userFavorites);
            } else {
            }
            return view('home.home')->with('allCoin', $allCoin)->with('topCoin', $topCoin);

        } catch (\Exception $e) {
            return redirect('/error429');
        }
    }
}
