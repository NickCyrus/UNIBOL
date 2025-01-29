<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePptoeqheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pptoeqhe', function (Blueprint $table) {
            $table->bigIncrements('eqheId');
            $table->integer('eqheTipo')->nullable();
            $table->integer('eqhepptoId')->nullable();
            $table->integer('eqheCodigo')->nullable();
            $table->string('eqheDesc')->nullable();
            $table->integer('eqheUnid')->nullable();
            $table->integer('eqheCantidad')->nullable();
            $table->integer('eqheNum')->nullable();
            $table->string('eqheModo', 1)->nullable();
            $table->integer('eqheValor')->nullable();
            $table->integer('eqheValPat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pptoeqhe');
    }
}
