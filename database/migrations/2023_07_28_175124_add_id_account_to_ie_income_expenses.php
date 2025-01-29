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
        Schema::table('ie_income_expenses', function (Blueprint $table) {
            $table->integer('id_account')->after('id_movement_type')->nullable();
            $table->date('date_income_expenses')->after('id_account')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ie_income_expenses', function (Blueprint $table) {
            //
        });
    }
};
