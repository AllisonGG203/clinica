<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id');
            $table->unsignedBigInteger('medicamento_id'); // Cambio para usar ID de `inventarios`
            $table->integer('cantidad');
            $table->string('frecuencia');
            $table->string('duracion');
            $table->text('notas')->nullable();
            $table->timestamps();

            // Establecer la relación con `consultas`
            $table->foreign('consulta_id')->references('id')->on('consultas')->onDelete('cascade');
            // Establecer la relación con `inventarios`
            $table->foreign('medicamento_id')->references('id')->on('inventarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('recetas');
    }
}
