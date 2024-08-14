<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Inventario;
use App\Models\Servicio;

//use App\Http\Controllers\ConsultaController;

class ConsultaController extends Controller
{
    public function index()
{
    $citas = Cita::with('paciente')
        ->orderByRaw("FIELD(estado, 'en_curso', 'pospuesta', 'finalizada') ASC")
        ->orderBy('fecha', 'desc')
        ->get();

    return view('consultas.index', compact('citas'));
}


public function show($id)
{
    $cita = Cita::with(['paciente', 'signosVitales', 'receta'])->findOrFail($id);
    $medicamentos = Inventario::all(); // Obtén todos los registros de inventarios
    $servicios = Servicio::all(); // Obtén todos los servicios

    return view('consultas.show', compact('cita', 'medicamentos', 'servicios'));
}




public function update(Request $request, $id)
{
    $consulta = Consulta::findOrFail($id);

    // Validar los datos ingresados
    $request->validate([
        'talla' => 'required',
        'peso' => 'required',
        'temperatura' => 'required',
        'presion_arterial' => 'required',
        'frecuencia_cardiaca' => 'required',
        'medicamento' => 'required',
        'cantidad' => 'required',
        'frecuencia' => 'required',
        'duracion' => 'required',
        'servicio_id' => 'required',
    ]);

    // Guardar los signos vitales
    $consulta->signosVitales()->updateOrCreate(
        ['consulta_id' => $consulta->id],
        $request->only(['talla', 'peso', 'temperatura', 'presion_arterial', 'frecuencia_cardiaca'])
    );

    // Guardar la receta
    $consulta->receta()->updateOrCreate(
        ['consulta_id' => $consulta->id],
        $request->only(['medicamento', 'cantidad', 'frecuencia', 'duracion', 'notas_receta'])
    );

    // Guardar el servicio
    $consulta->servicio_id = $request->input('servicio_id');
    
    // Actualizar el estado de la consulta
    $consulta->estado = 'finalizada';
    $consulta->save();

    // Redirigir a la vista de resumen
    return redirect()->route('consultas.resumen', ['id' => $consulta->id]);
}

public function resumen($id)
{
    $consulta = Consulta::with(['paciente', 'signosVitales', 'receta', 'servicio'])->findOrFail($id);
    $totalMedicamentos = $consulta->receta->cantidad * $consulta->receta->inventario->precio;
    $totalServicio = $consulta->servicio->precio;

    return view('consultas.resumen', compact('consulta', 'totalMedicamentos', 'totalServicio'));
}





public function store(Request $request)
{
    $consulta = new Consulta();
    $consulta->fecha = $request->input('fecha');
    $consulta->motivo = $request->input('motivo');
    // Otros campos de consulta

    // Guardar consulta
    $consulta->save();

    // Guardar signos vitales
    $consulta->signosVitales()->create([
        'talla' => $request->input('talla'),
        'peso' => $request->input('peso'),
        'temperatura' => $request->input('temperatura'),
        'presion_arterial' => $request->input('presion_arterial'),
        'frecuencia_cardiaca' => $request->input('frecuencia_cardiaca'),
    ]);

    return redirect()->route('consultas.index')->with('status', 'Consulta guardada con éxito');
}



public function finalizar($id)
{
    $consulta = Consulta::findOrFail($id);
    $consulta->estado = 'finalizada';
    $consulta->save();

    return redirect()->route('consultas.index')->with('success', 'Consulta finalizada exitosamente.');
}

public function posponer($id)
{
    $consulta = Consulta::findOrFail($id);
    $consulta->estado = 'pospuesta';
    $consulta->save();

    return redirect()->route('consultas.index')->with('success', 'Consulta pospuesta exitosamente.');
}

}
