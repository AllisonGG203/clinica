<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pacientes',
        'fecha',
        'hora',
        'motivo',
        'notas',
    ];
    

    public function paciente()
    {
        return $this->belongsTo(pacientes::class, 'id_pacientes');
    }
    public function receta()
    {
        return $this->hasOne(Receta::class, 'cita_id');
    }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

}
