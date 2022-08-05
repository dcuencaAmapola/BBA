<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('tipomov',20);
            $table->string('codigo',20);
            $table->string('prod');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('certificado',20);
            $table->string('departamento');
            $table->string('civ',20);
            $table->string('celular',20);
            $table->string('fechanac',20);
            $table->string('fecha1',20);
            $table->string('fechafin',20);
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
        Schema::dropIfExists('ingresos');
    }
}



