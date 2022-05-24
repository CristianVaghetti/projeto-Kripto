<?php

namespace App\Http\Controllers;

use App\Models\Kripto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Price;


class KriptosController extends Controller
{
    public function index(){
        $res = Http::get('https://testnet.binancefuture.com/fapi/v1/ticker/price');
        return $res->json();
        // dd($res->json());
    }

    public function getOne($symbol){
        $res = Http::get("https://testnet.binancefuture.com/fapi/v1/ticker/price?symbol={$symbol}");
        return $res->json();
    }

    public function getKriptos(){
        $allKriptos = $this->index();
        foreach($allKriptos as $byOne){
            $kripto = new Kripto();
            $kripto->symbol = $byOne['symbol'];
            $kripto->save();
        }
    }

    public function getPrice($symbol){
        $savePrice = new Price();
        $price = $this->getOne($symbol);
        $kripto = Kripto::where('symbol', $symbol)->first();
        var_dump($price);
        var_dump($kripto->symbol);
        var_dump($kripto->id);
        $savePrice->symbol = $kripto->id;
        $savePrice->bidPrice = $price['price'];
        $savePrice->save();
    }
}
