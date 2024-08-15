<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    public function paciente()
    {
        return $this->belongsTo(Pacientes::class);
    }

    public function consultar()
{
    return $this->belongsTo(Consultar::class, 'consultar_id');
}

    


// App\Models\Consulta.php
public function receta()
{
    return $this->hasOne(Receta::class, 'consulta_id');
}




    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
