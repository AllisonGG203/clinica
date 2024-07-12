<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pacientes', 'fecha', 'hora', 'motivo', 'notas'
    ];

    public function paciente()
    {
        return $this->belongsTo(Pacientes::class, 'id_pacientes');
    }
}
