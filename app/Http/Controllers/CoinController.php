<?php

namespace App\Http\Controllers;

use App\Models\Coins;
use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Illuminate\Http\Client\Response;


class CoinController extends Controller
{

    public function index()
    {
        $allCoins = Coins::paginate(45);
        return view('coin.allcoin')->with('allCoins', $allCoins);
    }

    public function show($id)
    {
        $client = new CoinGeckoClient();

        try {

            $detailCoin = $client->coins()->getCoin($id, ['tickers' => 'true', 'market_data' => 'true']);
            return view('coin.coin')->with('detailCoin', $detailCoin)->with('code', 'try');
        } catch (\Exception $e) {
            try {
                if (Coins::where('coins', $id)->first() == true) {
                    $coin = Coins::where('coins', $id)->first();
                    $detailCoin = $client->coins()->getCoin($coin['accronyme'], ['tickers' => 'true', 'market_data' => 'true']);
                    return view('coin.coin')->with('detailCoin', $detailCoin)->with('code', 'catch');
                }else {
                    return redirect('/error404');
                }
            } catch (\Exception $e) {
                if ($e->getCode() == 429) {
                    return redirect('/error429');
                }
            }
        }
    }

    // public function insertCoins(){
    //     $client = new CoinGeckoClient();
    //     $data = $client->coins()->getList();
    //     foreach ($data as $coin) {
    //         $model = new Coins();
    //         $model->coins = $coin['name'];
    //         $model->accronyme = $coin['id'];
    //         $model->save();
    //     }
    // }
}
