<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    use HasFactory;

    protected $fillable = [
        'consulta_id', 'talla', 'peso', 'temperatura', 'presion_arterial', 'frecuencia_cardiaca'
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
