<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Kripto;

class GetAllKriptos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'c:getAllKriptos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use this to save all kriptos on a table in database. You MUST do this step, because you will need to have a kripto to link the price which one you are looking for';

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
        $res = Http::get('https://testnet.binancefuture.com/fapi/v1/ticker/price');
        $allKriptos = $res->json();
        foreach($allKriptos as $byOne){
            $kripto = new Kripto();
            $kripto->symbol = $byOne['symbol'];
            $kripto->save();
        }
    }
}
