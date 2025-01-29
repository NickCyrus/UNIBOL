<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIeThirdpartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ie_thirdparties', function (Blueprint $table) {
            $table->id();
            $table->string('nit')->nullable();
            $table->string('name')->default('');
            $table->string('email')->nullable();
            $table->string('cellphone', 11)->default('');
            $table->string('address')->nullable();
            $table->integer('id_cat_third')->nullable();
            $table->integer('state')->nullable();
            $table->integer('id_user')->nullable();
            $table->timestamps();
            $table->string('code', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ie_thirdparties');
    }
}
