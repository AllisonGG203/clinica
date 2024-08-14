<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    protected $fillable = [
        'cita_id', 'talla', 'peso', 'temperatura', 'presion_arterial', 'frecuencia_cardiaca'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'cita_id');
    }
}
