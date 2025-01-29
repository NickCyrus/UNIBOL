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
        Schema::create('ie_income_expenses_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_income_expenses')->nullable();
            $table->integer('id_company')->nullable();
            $table->integer('id_movement_type')->nullable();
            $table->integer('id_thirdparti')->nullable();
            $table->integer('id_classification')->nullable();
            $table->integer('id_cost_centers')->nullable();
            $table->integer('id_concept')->nullable();
            $table->integer('id_accounts')->nullable();
            $table->decimal('price', 50, 0)->nullable();
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
        Schema::dropIfExists('ie_income_expenses_details');
    }
};
