<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kripto;
use Illuminate\Support\Facades\Http;
use App\Models\Price;
use Exception;

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
    protected $description = 'At this point, the command will get the last 100 prices from the table_prices then will check if the last one is 0.5% less than the average. 
    Is good to know, each price is linked with your respective symbol recorded in table_kriptos. So, it is possible to distinguish and save prices from diferent kriptos at same time.';

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
        try {
            $kripto = Kripto::where('symbol', $this->argument('symbol'))->first();
            $prices = Price::where('symbol', $kripto->id)->orderBy('created_at','desc')->take(100)->get();
            
            $countAll = count($prices);
            $total = 0;
            $lastOne = $prices[0]->bidPrice;
            foreach($prices as $price){
                $total += $price->bidPrice;
            }
            
            $average = $total/$countAll;
            $diff = ($lastOne - $average) / $average * 100;
            
            echo "\nAverage => " . $average . "\n";
            echo "Last => " . $lastOne;
            echo "\n" . "Difference => ". $diff . "\n";

           echo $diff < -0.5 ? "ALERT ALERT ALERT\n\n": "ALL GREEN\n\n";
            
            
        } catch(Exception $e) {
            echo 'Kripto not found !';
        }
        return 0;
    }
}
