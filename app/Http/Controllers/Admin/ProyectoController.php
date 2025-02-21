<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\estudiante;
use App\Models\proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.proyecto.index');
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
        $validatedData = $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'nombre_proyecto' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
        ]);

        $proyectos = new proyecto();

        $proyectos->estudiante_id = $validatedData['estudiante_id'];
        $proyectos->nombre_proyecto = $validatedData['nombre_proyecto'];
        $proyectos->descripcion = $validatedData['descripcion'];
        $proyectos->fecha = $validatedData['fecha'];
        $proyectos->hora = $validatedData['hora'];

        $proyectos->save();

        if ($proyectos){
            return redirect()->route('admin.proyecto.index')->with('success', 'El proyecto fue registrado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se registro correctamente el proyecto:' . $proyectos->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'estudiante_id' => 'required',
            'nombre_proyecto' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
        ]);

        $proyectos = proyecto::findOrFail($id);

        $proyectos->estudiante_id = $validatedData['estudiante_id'];
        $proyectos->nombre_proyecto = $validatedData['nombre_proyecto'];
        $proyectos->descripcion = $validatedData['descripcion'];
        $proyectos->fecha = $validatedData['fecha'];
        $proyectos->hora = $validatedData['hora'];

        $proyectos->save();

        if ($proyectos){
            return redirect()->route('admin.proyecto.index')->with('success', 'El proyecto fue actualizado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se actualizo correctamente el proyecto:' . $proyectos->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        proyecto::find($id)->delete();
        return redirect()->route('admin.proyecto.index')->with('success', 'El proyecto fue eliminado correctamente.');
    }

    public function buscar(Request $request)
    {
        $dni = $request->query('dni');

        if (!$dni) {
            return response()->json(['error' => 'Debe proporcionar un DNI'], 400);
        }

        $estudiante = estudiante::where('dni', $dni)->first();

        if ($estudiante) {
            return response()->json([
                'nombre' => $estudiante->nombre,
                'apellido' => $estudiante->apellido
            ]);
        } else {
            return response()->json(['error' => 'No se encontró el estudiante'], 404);
        }
    }
}
