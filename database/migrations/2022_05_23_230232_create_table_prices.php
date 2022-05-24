<?php

use App\Models\Kripto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('symbol');
            $table->foreign('symbol')->references('id')->on('table_kriptos');
            $table->float('bidPrice', 9, 9);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_prices', function (Blueprint $table) {
            $table->dropForeign('table_prices_symbol_foreign');
        });
        Schema::dropIfExists('table_prices');
    }
}
