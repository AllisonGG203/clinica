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
        return $this->belongsTo(Pacientes::class, 'paciente_id');
    }

    public function signosVitales()
    {
        return $this->hasOne(SignosVitales::class, 'consulta_id');
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class, 'consulta_id');
    }
}
