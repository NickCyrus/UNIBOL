<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsSendMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_send_mail', function (Blueprint $table) {
            $table->id();
            $table->integer('quoteid');
            $table->integer('userId');
            $table->string('subjet', 254)->nullable();
            $table->text('sendTo')->nullable();
            $table->string('adjunto', 254)->nullable();
            $table->longText('sendBody')->nullable();
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
        Schema::dropIfExists('logs_send_mail');
    }
}
