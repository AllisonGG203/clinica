<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id', 'motivo', 'notas', 'fecha'
    ];

    public function paciente()
{
    return $this->belongsTo(Pacientes::class, 'id_pacientes');
}

public function signosVitales()
{
    return $this->hasOne(SignosVitales::class, 'consulta_id');
}

public function receta()
{
    return $this->hasOne(Receta::class, 'consulta_id');
}

public function servicio()
{
    return $this->belongsTo(Servicio::class, 'servicio_id');
}

}
