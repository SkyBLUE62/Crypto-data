<?php

namespace App\Http\Controllers;

use App\Models\Coins;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function index()
    {
        $allCoins = Coins::all();
        if (Portfolio::where('idUser', '=', Auth::user()->id) == true) {
            $coinsWallet = Portfolio::where('idUser', '=', Auth::user()->id)->get();
            return view('portfolio.portfolio')->with([
                'allCoins' => $allCoins,
                'coinsWallet' => $coinsWallet,
            ]);
        }
        return view('portfolio.portfolio')->with('allCoins', $allCoins);
    }

    public function add_coin_wallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coin' => 'required|exists:coins,accronyme',
            'total-coin' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $model = new Portfolio();
        $accronymeCoin = $request->input('coin');
        $TotalCoin = $request->input('total-coin');
        $detailCoin = Coins::where('accronyme', '=', $accronymeCoin)->first();

        $model->totalCoins = $TotalCoin;
        $model->coins = $detailCoin['coins'];
        $model->idCoins = $detailCoin['id'];
        $model->idUser = Auth::user()->id;
        $model->save();
        return back()->with('alert', 'The coin was successfully added');
    }
}
