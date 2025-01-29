<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIeMovementTypeClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ie_movement_type_classifications', function (Blueprint $table) {
            $table->id();
            $table->integer('id_movement_type')->nullable();
            $table->integer('id_classification')->nullable();
            $table->integer('state')->nullable();
            $table->integer('id_user')->nullable();
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
        Schema::dropIfExists('ie_movement_type_classifications');
    }
}
