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
        Schema::create('ie_bank_balances', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_company');
            $table->integer('id_bank');
            $table->integer('id_account');
            $table->double('saldo_1')->comment('Disponible');
            $table->double('saldo_2')->comment('Dinero en canje/ACH');
            $table->double('saldo_3')->comment('Capital Embargado');
            $table->double('saldo_4')->comment('Valores Provisionados');
            $table->double('saldo_5')->comment('Cheques Postfechados');
            $table->double('saldo_6')->comment('Transf./Cheques Pend. por Cobro');
            $table->double('saldo_7')->comment('Sobregiro Aprobado');
            $table->double('saldo_8')->comment('Sobregiro Utilizado');
            $table->double('saldo_9')->comment('Días de Sobregiro');
            $table->boolean('state');
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
        Schema::dropIfExists('ie_bank_balances');
    }
};
