<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'consulta_id', 'medicamento', 'cantidad', 'frecuencia', 'duracion', 'notas',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}

