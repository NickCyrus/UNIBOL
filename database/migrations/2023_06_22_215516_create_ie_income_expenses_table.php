<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIeIncomeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ie_income_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('id_company')->nullable();
            $table->integer('id_movement_type')->nullable();
            $table->decimal('price', 50, 0)->nullable();
            $table->integer('state')->nullable();
            $table->integer('id_user')->nullable();
            $table->date('date')->nullable();
            $table->integer('tipdoc')->nullable();
            $table->string('doc')->nullable();
            $table->integer('tipcon')->nullable();
            $table->string('con')->nullable();
            $table->timestamps();
            $table->string('observation')->nullable();
            $table->integer('id_thirdparti')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ie_income_expenses');
    }
}
