<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Inventario;
use App\Models\Receta;
use App\Models\Servicio;
use App\MoonShine\Resources\ConsultarResource;

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
    // Encuentra la consulta específica
    $consulta = Consulta::with(['paciente', 'receta', 'servicio'])->findOrFail($id);

    // Otros datos que podrías necesitar
    $medicamentos = Inventario::all();
    $servicios = Servicio::all();

    // Verifica si la consulta está finalizada y redirige al resumen
    if ($consulta->estado === 'finalizada') {
        return view('consultas.resumen', compact('consulta', 'medicamentos', 'servicios'));
    }

    // Renderiza la vista de consulta
    return view('consultas.show', compact('consulta', 'medicamentos', 'servicios'));
}






public function consultar($id)
{
    $cita = Cita::with(['paciente', 'signosVitales', 'receta', 'servicio'])->findOrFail($id);

    return view('consultas.resumen', compact('cita'));
    
}


public function update(Request $request, $id)
{
    // Encuentra la consulta específica
    $consulta = Consulta::findOrFail($id);

    // Guardar los signos vitales en la tabla 'consultas'
    $consulta->update([
        'talla' => $request->input('talla'),
        'peso' => $request->input('peso'),
        'temperatura' => $request->input('temperatura'),
        'presion_arterial' => $request->input('presion_arterial'),
        'frecuencia_cardiaca' => $request->input('frecuencia_cardiaca'),
    ]);

    // Guardar la receta en la tabla 'recetas'
    $consulta->receta()->updateOrCreate(
        ['consulta_id' => $consulta->id],
        [
            'medicamento' => $request->input('medicamento'),
            'cantidad' => $request->input('cantidad'),
            'frecuencia' => $request->input('frecuencia'),
            'duracion' => $request->input('duracion'),
            'notas' => $request->input('notas_receta'),
        ]
    );

    // Cambiar el estado de la consulta a 'finalizada'
    $consulta->estado = 'finalizada';
    $consulta->save();

    // Redirigir al resumen de la consulta
    return redirect()->route('consultas.resumen', $consulta->id);
}



public function store(Request $request)
{
    // Crear una nueva instancia de Consulta
    $consulta = new Consulta();
    
    // Asignar los valores desde el request
    $consulta->fecha = $request->input('fecha');
    $consulta->motivo = $request->input('motivo');
    $consulta->estado = 'en_curso'; // Asegúrate de que el estado se inicializa como 'en_curso'

    // Guardar la consulta para que se genere su ID
    $consulta->save();

    // Usar el ID de la consulta recién creada para guardar los signos vitales
    $consulta->signosVitales()->create([
        'talla' => $request->input('talla'),
        'peso' => $request->input('peso'),
        'temperatura' => $request->input('temperatura'),
        'presion_arterial' => $request->input('presion_arterial'),
        'frecuencia_cardiaca' => $request->input('frecuencia_cardiaca'),
    ]);

    // Redirigir a la lista de consultas o mostrar un mensaje de éxito
    return redirect()->route('consultas.index')->with('status', 'Consulta guardada con éxito');
}





public function finalizar($id)
{
    $consulta = Consulta::findOrFail($id);
    $consulta->estado = 'finalizada';
    $consulta->save();

    return redirect()->route('consultas.index')->with('success', 'Consulta finalizada exitosamente.');
    

}
public function resumen($id)
{
    // Encuentra la consulta específica
    $consulta = Consulta::with(['paciente', 'receta', 'servicio'])->findOrFail($id);

    // Calcula el costo total de la consulta
    $totalMedicamentos = $consulta->receta->cantidad * $consulta->receta->medicamento->precio;
    $totalServicio = $consulta->servicio->precio;
    $total = $totalMedicamentos + $totalServicio;

    // Renderiza la vista de resumen con los datos necesarios
    return view('consultas.resumen', compact('consulta', 'totalMedicamentos', 'totalServicio', 'total'));
}




public function posponer($id)
{
    $consulta = Consulta::findOrFail($id);
    $consulta->estado = 'pospuesta';
    $consulta->save();

    return redirect()->route('consultas.index')->with('success', 'Consulta pospuesta exitosamente.');
}

}
