<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIeCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ie_companies', function (Blueprint $table) {
            $table->id();
            $table->string('nit')->nullable();
            $table->string('name')->nullable();
            $table->integer('state')->nullable();
            $table->integer('id_user')->nullable();
            $table->timestamps();
            $table->string('cellphone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ie_companies');
    }
}
