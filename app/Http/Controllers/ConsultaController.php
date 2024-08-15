<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Consultar;
use App\Models\Inventario;
use App\Models\Receta;
use App\Models\Servicio;
use App\MoonShine\Resources\ConsultarResource;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Adapter\PDFLib;

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


public function update(Request $request, $id)
{
    // Encontrar la cita correspondiente
    $cita = Cita::findOrFail($id);

    // Verificar que la consulta existe y está vinculada a la cita
    $consulta = Consulta::where('cita_id', $cita->id)->firstOrFail();

    // Actualizar los signos vitales
    $consulta->update([
        'talla' => $request->input('talla'),
        'peso' => $request->input('peso'),
        'temperatura' => $request->input('temperatura'),
        'presion_arterial' => $request->input('presion_arterial'),
        'frecuencia_cardiaca' => $request->input('frecuencia_cardiaca'),
    ]);

    // Actualizar el estado de la consulta
    $consulta->estado = 'finalizada';
    $consulta->save();

    // Redirigir al resumen de la consulta
    return redirect()->route('consultas.resumen', ['id' => $consulta->id]);
    dd($consulta); // Detiene la ejecución y muestra la consulta, para depuración.

}






public function store(Request $request)
{
    $consulta = new Consulta();

    $consulta->paciente_id = $request->input('paciente_id');
    $consulta->cita_id = $request->input('cita_id'); 
    $consulta->fecha = $request->input('fecha');
    $consulta->motivo = $request->input('motivo');
    $consulta->estado = 'en_curso'; 
    $consulta->talla = $request->input('talla');
    $consulta->peso = $request->input('peso');
    $consulta->temperatura = $request->input('temperatura');
    $consulta->presion_arterial = $request->input('presion_arterial');
    $consulta->frecuencia_cardiaca = $request->input('frecuencia_cardiaca');
    $consulta->save();

    return redirect()->route('consultas.index')->with('status', 'Consulta creada con éxito');
}





public function show($id)
{
    
    $cita = Cita::with(['paciente', 'receta', 'servicio'])->findOrFail($id);
    $medicamentos = Inventario::all();
    $servicios = Servicio::all();

    return view('consultas.show', compact('cita', 'medicamentos', 'servicios'));
}


    

    public function resumen($id)
    {
        // Aquí buscamos la consulta por su ID
        $consulta = Consulta::with(['receta', 'servicio', 'paciente'])->findOrFail($id);
    
        // Calculamos los costos totales si es necesario
        $totalMedicamentos = $consulta->receta->cantidad * $consulta->receta->medicamento->precio;
        $totalServicio = $consulta->servicio->precio;
        $total = $totalMedicamentos + $totalServicio;
    
        // Mostramos la vista con los datos
       
        return view('consultas.resumen', compact('consulta'));
    }
    
    
public function generarPDF(Request $request)
{
    $data = $request->all(); // Captura todos los datos del formulario

    // Procesa los datos y genera el PDF
    $pdf = \PDF::loadView('consultas.pdf', compact('data'));

    // Devuelve el PDF para descargar
    return $pdf->download('consulta.pdf');
}






}
