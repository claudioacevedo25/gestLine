<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->float('precio_costo');
            $table->integer('rentabilidad');
            $table->float('precio_venta');
            $table->integer('stock');
            $table->integer('qty');
            $table->string('img');
            $table->string('observaciones');
            $table->bigInteger('id_proveedor');
            $table->bigInteger('id_categoria');
            $table->tinyInteger('estado')->default(1);
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
        Schema::dropIfExists('articulos');
    }
}
