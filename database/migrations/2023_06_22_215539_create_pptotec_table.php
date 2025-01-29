<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePptotecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pptotec', function (Blueprint $table) {
            $table->bigIncrements('pptoId');
            $table->string('pptoComercial')->nullable();
            $table->string('pptoProyecto')->nullable();
            $table->string('pptoCliente')->nullable();
            $table->string('pptoCc')->nullable();
            $table->string('pptoPr', 100)->nullable();
            $table->integer('pptoOt')->nullable();
            $table->date('pptoFecha')->nullable();
            $table->string('pptoResponsable')->nullable();
            $table->date('pptoFecIni')->nullable();
            $table->date('pptoFecFin')->nullable();
            $table->integer('pptoCotId')->nullable();
            $table->string('pptoCotDesc')->nullable();
            $table->string('pptoCotUni', 20)->default('');
            $table->integer('pptoCotValPar')->nullable();
            $table->integer('pptoCotValTot')->nullable();
            $table->integer('pptoCotDur')->nullable();
            $table->integer('pptoFinan');
            $table->integer('pptoAdmCen');
            $table->integer('pptoOtros');
            $table->string('pptoObsr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pptotec');
    }
}
