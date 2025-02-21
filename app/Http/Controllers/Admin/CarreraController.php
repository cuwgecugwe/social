<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // Define un método llamado "index" en el controlador.
    {
        return view('admin.carrera.index'); // Retorna la vista ubicada en `resources/views/admin/carrera/index.blade.php`.
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
            'nombre_carrera' => 'required',
            'abreviatura' => 'required',
        ]);

        $carreras = new carrera();

        $carreras->nombre_carrera = $validatedData['nombre_carrera'];
        $carreras->abreviatura = $validatedData['abreviatura'];

        $carreras->save();

        if ($carreras){
            return redirect()->route('admin.carrera.index')->with('success', 'La carrera fue registrado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se registro correctamente la carrera:' . $carreras->getMessage());
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
            'nombre_carrera' => 'required',
            'abreviatura' => 'required',
        ]);

        $carreras = carrera::findOrFail($id);

        $carreras->nombre_carrera = $validatedData['nombre_carrera'];
        $carreras->abreviatura = $validatedData['abreviatura'];

        $carreras->save();

        if ($carreras){
            return redirect()->route('admin.carrera.index')->with('success', 'La carrera fue actualizado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se actualizo correctamente la carrera:' . $carreras->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        carrera::find($id)->delete();
        return redirect()->route('admin.carrera.index')->with('success', 'La carrera fue eliminado correctamente.');
    }
}
