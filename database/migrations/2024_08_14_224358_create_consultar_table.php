<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id');
            $table->string('talla');
            $table->string('peso');
            $table->string('temperatura');
            $table->string('presion_arterial');
            $table->string('frecuencia_cardiaca');
            $table->timestamps();
        
            $table->foreign('consulta_id')->references('id')->on('consultas')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultar');
    }
};
