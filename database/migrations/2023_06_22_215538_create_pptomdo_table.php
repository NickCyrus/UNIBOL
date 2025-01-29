<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePptomdoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pptomdo', function (Blueprint $table) {
            $table->bigIncrements('mdoId');
            $table->integer('mdoTipo')->nullable();
            $table->integer('mdoPptoId')->nullable();
            $table->integer('mdoCod')->nullable();
            $table->string('mdoDesc')->nullable();
            $table->integer('mdoCant')->nullable();
            $table->integer('mdoDias')->nullable();
            $table->integer('mdoSalario')->nullable();
            $table->integer('mdoPreSoc')->nullable();
            $table->integer('mdoSalTot')->nullable();
            $table->integer('mdoSalPat')->nullable();
            $table->double('mdoPorPreSoc', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pptomdo');
    }
}
