<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_situatione_models', function (Blueprint $table) {
            $table->id();
            $table->integer('rubro_id')->nullable();
            $table->integer('orden_id')->nullable();
            $table->integer('homologation_id')->nullable();
            $table->integer('EEFFR_rubro_id')->nullable();
            $table->integer('EEFFR_orden_id')->nullable();
            $table->integer('nota_balance_id')->nullable();
            $table->bigInteger('saldo')->nullable();
            $table->integer('ano')->nullable();
            $table->integer('Month_id')->nullable();
            $table->integer('import_id')->nullable();
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
        Schema::dropIfExists('financial_situatione_models');
    }
};
