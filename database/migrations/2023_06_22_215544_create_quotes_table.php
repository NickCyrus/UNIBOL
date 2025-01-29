<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->integer('contracts_id')->nullable();
            $table->string('description')->nullable();
            $table->string('cc_solutec', 25)->nullable();
            $table->string('n_pr', 25)->nullable();
            $table->string('n_pedido', 25)->nullable();
            $table->string('lider_fec', 50)->nullable();
            $table->integer('state')->nullable();
            $table->string('vr_creada', 50)->nullable();
            $table->string('vr_pendiente', 50)->nullable();
            $table->string('vr_suspendidos', 50)->nullable();
            $table->string('vr_aprobar', 50)->nullable();
            $table->string('vr_aprobado', 50)->nullable();
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
        Schema::dropIfExists('quotes');
    }
}
