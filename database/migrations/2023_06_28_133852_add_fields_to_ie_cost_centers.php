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
        Schema::table('ie_cost_centers', function (Blueprint $table) {
            //
            $table->integer('id_parent')->nullable();
            $table->integer('id_classification')->nullable();
            $table->integer('level')->nullable();
            $table->decimal('ppto', 50, 2)->nullable();
            $table->string('area')->nullable();
            $table->string('id_area')->nullable();
            $table->timestamp('datesol')->nullable();
            $table->string('solicitante')->nullable();
            $table->string('responsable')->nullable();
            $table->integer('id_account')->nullable();
            $table->string('proyectname')->nullable();
            $table->string('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ie_cost_centers', function (Blueprint $table) {
            //
        });
    }
};
