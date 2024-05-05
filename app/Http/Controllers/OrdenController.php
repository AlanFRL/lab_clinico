<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\TipoAnalisis;
use App\Models\OrdenAnalisis;
use Illuminate\Support\Facades\DB;
use App\Models\Analisis;
use App\Models\Bioquimico;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = [
            'Id',
            'Tipo Analisis',
            'Fecha',
            'Id Solicitud',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $orden = Orden::all();
        $ordenesConAnalisis = Orden::with('ordenAnalisis')->get();
        $datosOrdenAnalisis = OrdenAnalisis::with('tipoAnalisis')->get();


        // dd($orden); // Verificar los datos antes de pasarlos a la vista
        $tipoanalisis = TipoAnalisis::all();
        $bioquimico = Bioquimico::all();
        return view('orden.index', compact('ordenesConAnalisis', 'datosOrdenAnalisis', 'orden', 'tipoanalisis', 'bioquimico', 'heads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $idOrden = $request->idOrden;
        if ($idOrden == null) {
            $orden = new Orden();
            $orden->save();
            $idOrden = $orden->id;
        }

        // Registrar la relación en la tabla intermedia orden_analisis
        $tipoAnalisisIds = $request->input('tipoAnalisisIds'); // Suponiendo que tienes un array de IDs de tipo de análisis desde el formulario
        foreach ($tipoAnalisisIds as $tipoAnalisisId) {
            // Insertar en la tabla intermedia
            DB::table('orden_analisis')->insert([
                'orden_id' => $idOrden,
                'tipo_analisis_id' => $tipoAnalisisId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Obtener el nombre del tipo de análisis utilizando el ID
            $tipoAnalisis = TipoAnalisis::find($tipoAnalisisId);

            // Crear un nuevo análisis para la orden
            $analisis = new Analisis();
            $analisis->idBioquimico = $request->idBioquimico;
            $analisis->estado = 'Pendiente';
            $analisis->descripcion =  $tipoAnalisis->nombre; // Acceder al nombre del tipo de análisis
            $analisis->idOrden = $idOrden;
            $analisis->save();
        }
        activity()
            ->causedBy(auth()->user())
            ->withProperties(request()->ip())
            ->log('Se registró un análisis para la orden con el ID: ' . $idOrden);

        session()->flash('success', 'Se registró exitosamente');
        return redirect()->route('orden.index')->with('success', '¡El análisis se ha registrado exitosamente!');
    }




    /**
     * Display the specified resource.
     */
    public function show(Orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orden $orden)
    {
        $orden->delete();
        return redirect()->route('orden.index')->with('success', 'Eliminado correctamente');
    }
}
