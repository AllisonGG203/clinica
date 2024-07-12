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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pacientes');
            $table->unsignedBigInteger('id_medico');
            $table->foreign('id_pacientes')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('id_medico')->references('id')->on('medico')->onDelete('cascade')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->string('motivo');
            $table->string('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
