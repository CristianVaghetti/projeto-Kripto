<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Price;
use App\Models\Kripto;
use Exception;

class saveBidPriceOnDataBase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'c:saveBidPriceOnDataBase {symbol}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This command you will get the kriptos's price fom Binance API, sending a parameter to look for the wished kripto";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $price = Http::get("https://testnet.binancefuture.com/fapi/v1/ticker/price?symbol={$this->argument('symbol')}");
        $savePrice = new Price();
        try{
            $kripto = Kripto::where('symbol', $this->argument('symbol'))->first();

            $savePrice->symbol = $kripto->id;
            $savePrice->bidPrice = $price['price'];
            $savePrice->save();

            echo 'Done!';
            
        } catch(Exception $e){
            echo 'Kripto not found !';
        }
        return 0;
    }
}
