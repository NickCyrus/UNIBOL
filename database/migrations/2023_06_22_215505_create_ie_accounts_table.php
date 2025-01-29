<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIeAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ie_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('account')->default('');
            $table->date('date_opening')->nullable();
            $table->integer('status')->nullable();
            $table->integer('id_account_type')->nullable();
            $table->integer('state')->nullable();
            $table->integer('id_user')->nullable();
            $table->timestamps();
            $table->integer('id_bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ie_accounts');
    }
}
