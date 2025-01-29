<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIeSubCostcentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ie_sub_costcenters', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cost_center')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->integer('state')->nullable();
            $table->integer('id_user')->nullable();
            $table->timestamps();
            $table->integer('id_parent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ie_sub_costcenters');
    }
}
