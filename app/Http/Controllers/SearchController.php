<?php

namespace App\Http\Controllers;

use App\Models\Coins;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        $data = array(
            'nomCoin' => array(),
        );
        $allCoins = Coins::all();
        foreach ($allCoins as $row) {
            $data['nomCoin'][] = $row['coins'];
        }
        return response()->json($data);
    }

    public function search(Request $request){
        // /search/redirect
        $id = $request->input('searchbar');
        return redirect('/coin/'.$id);
    }
}
