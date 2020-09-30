<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('direccion')->nullable();
            $table->integer('telefono');
            $table->string('email')->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->integer('id_rubro');
            $table->timestamps();

            $table->foreign('id_rubro')->references('id')->on('rubros');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
