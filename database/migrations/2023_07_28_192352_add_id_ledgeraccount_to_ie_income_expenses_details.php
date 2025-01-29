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
        Schema::table('ie_income_expenses_details', function (Blueprint $table) {
            //
            $table->integer('id_ledgeraccount')->after('id_accounts')->nullable();
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ie_income_expenses_details', function (Blueprint $table) {
            //
        });
    }
};
