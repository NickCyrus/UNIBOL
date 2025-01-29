<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesappsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulesapps', function (Blueprint $table) {
            $table->id();
            $table->integer('id_parent')->nullable();
            $table->timestamps();
            $table->string('nameapp');
            $table->string('iconapp')->nullable();
            $table->string('urlapp')->nullable()->unique('modulesapps_urlapp_unique');
            $table->integer('orderapp')->nullable();
            $table->integer('state')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modulesapps');
    }
}
