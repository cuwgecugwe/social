<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // Define un método llamado "index" en el controlador.
    {
        return view('admin.estudiante.index'); // Retorna la vista ubicada en `resources/views/admin/carrera/index.blade.php`.
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
            'dni' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'promocion' => 'required',
            'carrera_id' => 'required|exists:carreras,id',
        ]);

        $estudiantes = new estudiante();

        $estudiantes->dni = $validatedData['dni'];
        $estudiantes->nombre = $validatedData['nombre'];
        $estudiantes->apellido = $validatedData['apellido'];
        $estudiantes->promocion = $validatedData['promocion'];
        $estudiantes->carrera_id = $validatedData['carrera_id'];
        $estudiantes->save();

        if ($estudiantes){
            return redirect()->route('admin.estudiante.index')->with('success', 'El estudiante fue registrado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se registro correctamente el estudiante:' . $estudiantes->getMessage());
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
            'dni' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'promocion' => 'required',
            'carrera_id' => 'required|exists:carreras,id',
        ]);

        $estudiantes = estudiante::findOrFail($id);

        $estudiantes->dni = $validatedData['dni'];
        $estudiantes->nombre = $validatedData['nombre'];
        $estudiantes->apellido = $validatedData['apellido'];
        $estudiantes->promocion = $validatedData['promocion'];
        $estudiantes->carrera_id = $validatedData['carrera_id'];

        $estudiantes->save();

        if ($estudiantes){
            return redirect()->route('admin.estudiante.index')->with('success', 'El estudiante fue actualizado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se actualizo correctamente el estudiante:' . $estudiantes->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        estudiante::find($id)->delete();
        return redirect()->route('admin.estudiante.index')->with('success', 'El estudiante fue eliminado correctamente.');
    }
}
