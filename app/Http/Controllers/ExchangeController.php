<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use App\Models\Exchange;

class ExchangeController extends Controller
{
    public function index()
    {
        try {
            $client = new CoinGeckoClient();
            $globalData = $client->globals()->getGlobal();
            $dataExchange = $client->exchanges()->getExchanges();
            $dataBTC = $client->coins()->getCoin('bitcoin', ['tickers' => 'false', 'market_data' => 'true']);
            $data = $client->exchanges()->getList();
            return view('exchange.exchangeAll')->with('globalData', $globalData)->with('dataExchange', $dataExchange)->with('dataBTC', $dataBTC)->with('data', $data);
        } catch (\Exception $e) {
            if ($e->getCode() == 429) {
                return redirect('/error429');
            }
            if ($e->getCode() == 404) {
                return redirect('/error429');
            }
        }
    }

    // public function insertExchange()
    // {
    //     $client = new CoinGeckoClient();
    //     $dataExchange = $client->exchanges()->getExchanges();
    //     foreach ($dataExchange as $exchange) {
    //         $model = new Exchange();
    //         $model->exchange = $exchange['name'];
    //         $model->accronyme = $exchange['id'];
    //         $model->save();
    //     }
    // }
}
