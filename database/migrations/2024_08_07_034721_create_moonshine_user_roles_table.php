<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Importar el facade DB

class CreateMoonshineUserRolesTable extends Migration
{
    public function up()
    {
        Schema::create('moonshine_user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insertar roles predeterminados
        DB::table('moonshine_user_roles')->insert([
            ['name' => 'admin'],
            ['name' => 'medico'],
            ['name' => 'secretaria'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('moonshine_user_roles');
    }
}
