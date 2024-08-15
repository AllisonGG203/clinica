<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{

    protected $table = 'consultas';

    public function paciente()
    {
        return $this->belongsTo(Pacientes::class);
    }
    public function consulta()
    {
    return $this->belongsTo(Consultar::class, 'consulta_id');
    }

    public function receta()
    {
        return $this->hasOne(Receta::class, 'consulta_id');
    }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
    public function Cita()
    {
        return $this->belongsTo(cita::class, 'cita_id');
    }
    


}
