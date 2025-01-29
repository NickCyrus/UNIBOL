<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes_items', function (Blueprint $table) {
            $table->id();
            $table->integer('contracts_id')->nullable();
            $table->integer('quote_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('item_valor')->nullable();
            $table->integer('item_quantity')->nullable();
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
        Schema::dropIfExists('quotes_items');
    }
}
