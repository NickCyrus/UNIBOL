<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfpermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profpermissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('profid');
            $table->integer('modappid');
            $table->integer('aview')->nullable();
            $table->integer('anew')->nullable();
            $table->integer('aedit')->nullable();
            $table->integer('adelete')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profpermissions');
    }
}
