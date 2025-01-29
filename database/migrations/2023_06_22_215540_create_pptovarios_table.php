<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePptovariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pptovarios', function (Blueprint $table) {
            $table->bigIncrements('varId');
            $table->integer('varTipo')->nullable();
            $table->integer('varTIpoSer')->nullable();
            $table->integer('varpptoId')->nullable();
            $table->integer('varCodigo')->nullable();
            $table->string('varDesc')->nullable();
            $table->integer('varUnid')->nullable();
            $table->integer('varCantidad')->nullable();
            $table->integer('varValor')->nullable();
            $table->integer('varValPar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pptovarios');
    }
}
