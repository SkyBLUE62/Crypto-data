<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coins;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIfavoriteController extends Controller
{
    public function addToFavorite($id)
    {
        $modelFavorite = new Favorite();
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401)
                ->header('Content-Type', 'application/json');
        }

        $detailCoin = Coins::where('accronyme', '=', $id)->first();
        if ($detailCoin) {
            $modelFavorite->nameCoins = $detailCoin->coins;
            $modelFavorite->accronyme = $detailCoin->accronyme;
            $modelFavorite->idCoins = $detailCoin->id;
            $modelFavorite->idUser = $user->id;
            $modelFavorite->save();
            return response()->json([
                'message' => 'Coin ajouté aux favoris'
            ], 200);
        }
        return response()->json(['message' => 'Coin introuvable dans les favoris'], 404)
            ->header('Content-Type', 'application/json');
    }

    public function deleteFavorite($id)
    {
        if (Auth::user() != null) {
            $user = Auth::user();
        } else {
            return response()->json(['error' => 'Not authorized'], 401);
        }

        $favorite = Favorite::where('idUser', $user->id)->where('accronyme', $id)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Coin supprimé des favoris'], 200);
        }
        return response()->json(['error' => 'Coin introuvable dans les favoris'], 404);
    }
}
