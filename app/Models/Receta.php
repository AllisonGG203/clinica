<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{

    public function index()
    {
        $consultas = Consulta::with(['paciente', 'signosVitales', 'recetas', 'servicio'])->orderBy('fecha', 'desc')->get();
        return view('consulta.index', compact('consultas'));
    }
    
    use HasFactory;

    protected $fillable = [
        'consulta_id', 'medicamento', 'cantidad', 'frecuencia', 'duracion', 'notas'
    ];

    // App\Models\Receta.php
public function consulta()
{
    return $this->belongsTo(Consulta::class, 'consulta_id');
}

}
