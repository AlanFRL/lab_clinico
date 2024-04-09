<?php

namespace App\Http\Controllers;

use App\Models\TipoAnalisis;
use Illuminate\Http\Request;


class TipoAnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tipoanalisis = tipoanalisis::all();
        return view('VistaTipoAnalisis.index', compact('tipoanalisis'));
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
          // Validar los datos del formulario
          $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        // Crear una nueva instancia del modelo TipoSeguro
        $tipoSeguro = new TipoAnalisis();

        // Asignar los valores del formulario a las propiedades del modelo
        $tipoSeguro->nombre = $request->nombre;
        $tipoSeguro->descripcion = $request->descripcion;
        $tipoSeguro->precio = $request->precio;

        // Guardar el tipo de seguro en la base de datos
        $tipoSeguro->save();

        // Redirigir a la página de índice de tipos de seguro con un mensaje de éxito
        return redirect()->route('tipoanalisis.index')->with('success', '¡El tipo de seguro se ha registrado exitosamente!');

    }

    /**
     * Display the specified resource.
     */
    public function show(TipoAnalisis $tipoAnalisis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoAnalisis $tipoAnalisis)
    {
        return view('VistaTipoAnalisis.edit', compact('tipoAnalisis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoAnalisis $tipoAnalisis)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        // Actualizar los datos del tipo de seguro
        $tipoAnalisis->nombre = $request->nombre;
        $tipoAnalisis->descripcion = $request->descripcion;
        $tipoAnalisis->precio = $request->precio;
        $tipoAnalisis->save();

        // Redirigir a la página de índice de tipos de seguro con un mensaje de éxito
        return redirect()->route('tipoanalisis.index')->with('success', 'Los datos del tipo de seguro han sido actualizados correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoAnalisis $tipoAnalisis)
    {
        $tipoAnalisis->delete();
        return redirect()->route('tipoanalisis.index')->with('success', 'Eliminado correctamente');

    }
}
