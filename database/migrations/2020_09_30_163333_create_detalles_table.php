<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('id_factura');
            $table->integer('id_articulo');
            $table->string('observaciones');
            $table->float('precio_unitario');
            $table->integer('cantidad');
            $table->timestamps();


            $table->foreign('id_factura')->references('id')->on('facturas');
            $table->foreign('id_articulo')->references('id')->on('articulos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles');
    }
}
