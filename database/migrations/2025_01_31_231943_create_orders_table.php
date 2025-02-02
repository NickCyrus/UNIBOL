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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('solicitante');
            $table->string('doc_venta')->unique();
            $table->string('unidad_negocio');
            $table->string('linea_producto');
            $table->string('marca');
            $table->string('id_material');
            $table->string('material_name');
            $table->integer('cantidad_pendiente');
            $table->integer('saldo');
            $table->timestamps();

            $table->foreign('id_material')->references('id_material')->on('inventories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
