<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kripto;
use Illuminate\Support\Facades\Http;
use App\Models\Price;

class checkAvgBigPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'c:checkAvgBigPrice {symbol}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $kripto = Kripto::where('symbol', $this->argument('symbol'))->first();

        $prices = Price::where('symbol', $kripto->id)->get();
        
        $countAll = count($prices);
        $amount = 0;

        foreach($prices as $price){
            $amount = $amount + $price->bidPrice;
            $lastOne = $price->bidPrice;
            echo $price->bidPrice . "\n";
        }

        $res = $amount/$countAll;
        
        $diff = ($lastOne - $res) / $res * 100;

        $check = $diff < -0.5 ? 'sim' : 'não';
        

        echo("--------------\n" . $res);
        echo "\n" . $diff;
        echo "\n" . $check;
        return 0;
    }
}
