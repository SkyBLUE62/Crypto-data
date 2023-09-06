<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChartResource;
use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class ChartCoinController extends Controller
{

    public function show($id)
    {

        $client = new CoinGeckoClient();

        $dataChart = array(
            'marketDataPrice24h' => array(),
            'marketDataTime24h' => array(),
            'marketDataPrice7j' => array(),
            'marketDataTime7j' => array(),
            'marketDataPrice1m' => array(),
            'marketDataTime1m' => array(),
            'marketDataPriceAll' => array(),
            'marketDataTimeAll' => array(),
        );


        $date = strtotime(date("Y-m-d H:i:s"));
        $date24h = strtotime(date("Y-m-d H:i:s", strtotime('-1 day')));
        $date7j = strtotime(date("Y-m-d H:i:s", strtotime('-7 day')));
        $date1m = strtotime(date("Y-m-d H:i:s", strtotime('-1 month')));

        $marketData24h = $client->coins()->getMarketChartRange($id, 'usd', $date24h, $date);
        $marketData7j = $client->coins()->getMarketChartRange($id, 'usd', $date7j, $date);
        $marketData1m = $client->coins()->getMarketChartRange($id, 'usd', $date1m, $date);
        $detailCoin = $client->coins()->getCoin($id, ['tickers' => 'false', 'market_data' => 'false']);
        $marketDataAll = $client->coins()->getMarketChartRange($id, 'usd', strtotime($detailCoin['genesis_date']), $date);

        // Pour 24h

        for ($i = 0; $i < count($marketData24h['prices']); $i++) {

            if ($marketData24h['prices'][$i][1] > 1000) {
                $dataChart['marketDataPrice24h'][$i] = (string)str_replace(',', "", number_format($marketData24h['prices'][$i][1], 0));
            } elseif ($marketData24h['prices'][$i][1] < 1) {
                $dataChart['marketDataPrice24h'][$i] = (string)$marketData24h['prices'][$i][1];
            } else {
                $dataChart['marketDataPrice24h'][$i] = (string)str_replace(',', "", number_format($marketData24h['prices'][$i][1], 2));
            }
            $dataChart['marketDataTime24h'][$i] =  date('d/m H:i:s', substr($marketData24h['prices'][$i][0], 0, -3));
        }

        // Pour 7j

        for ($i = 0; $i < count($marketData7j['prices']); $i++) {
            if ($marketData7j['prices'][$i][1] > 1000) {
                $dataChart['marketDataPrice7j'][$i] = (string)str_replace(',', "", number_format($marketData7j['prices'][$i][1], 0));
            } elseif ($marketData7j['prices'][$i][1] < 1) {
                $dataChart['marketDataPrice7j'][$i] = (string)$marketData7j['prices'][$i][1];
            } else {
                $dataChart['marketDataPrice7j'][$i] = (string)str_replace(',', "", number_format($marketData7j['prices'][$i][1], 2));
            }
            $dataChart['marketDataTime7j'][$i] =  date('d/m H:i:s', substr($marketData7j['prices'][$i][0], 0, -3));
        }

        // Pour 1 month

        for ($i = 0; $i < count($marketData1m['prices']); $i++) {
            if ($marketData1m['prices'][$i][1] > 1000) {
                $dataChart['marketDataPrice1m'][$i] = (string)str_replace(',', "", number_format($marketData1m['prices'][$i][1], 0));
            } elseif ($marketData1m['prices'][$i][1] < 1) {
                $dataChart['marketDataPrice1m'][$i] = (string)$marketData1m['prices'][$i][1];
            } else {
                $dataChart['marketDataPrice1m'][$i] = (string)str_replace(',', "", number_format($marketData1m['prices'][$i][1], 2));
            }
            $dataChart['marketDataTime1m'][$i] =  date('d/m H:i:s', substr($marketData1m['prices'][$i][0], 0, -3));
        }

        // Pour All
        if ($detailCoin['genesis_date'] != null || $detailCoin['genesis_date'] != '') {
            for ($i = 0; $i < count($marketDataAll['prices']); $i++) {
                if ($marketDataAll['prices'][$i][1] > 1000) {
                    $dataChart['marketDataPriceAll'][$i] = (string)str_replace(',', "", number_format($marketDataAll['prices'][$i][1], 0));
                } elseif ($marketDataAll['prices'][$i][1] < 1) {
                    $dataChart['marketDataPriceAll'][$i] = (string)$marketDataAll['prices'][$i][1];
                } else {
                    $dataChart['marketDataPriceAll'][$i] = (string)str_replace(',', "", number_format($marketDataAll['prices'][$i][1], 2));
                }
                $dataChart['marketDataTimeAll'][$i] =  date('d/m/Y', substr($marketDataAll['prices'][$i][0], 0, -3));
            }
        }

        return response()->json($dataChart);
    }
}
