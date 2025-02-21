<?php

namespace App\Livewire\Admin;

use App\Models\carrera;
use App\Models\estudiante;
use Livewire\Component;

class EstudianteIndex extends Component
{
    // Esta clase define un componente Livewire llamado "EstudianteIndex".
    public function render()
    {
        // Este método se ejecuta cada vez que el componente se renderiza (se muestra en la pantalla).
        
        $carreras = carrera::all();
        // Obtiene todos los registros de la tabla "carreras" y los guarda en la variable $carreras.
        // `carrera::all()` es una consulta a la base de datos que devuelve una colección de todas las carreras.

        $estudiante = estudiante::all();
        // Obtiene todos los registros de la tabla "estudiantes" y los guarda en la variable $estudiante.
        // `estudiante::all()` es una consulta a la base de datos que devuelve una colección de todos los estudiantes.

        return view('livewire.admin.estudiante-index', compact('estudiante', 'carreras'));
        // Retorna la vista "livewire.admin.estudiante-index" (ubicada en resources/views/livewire/admin/estudiante-index.blade.php).
        // La función `compact('estudiante', 'carreras')` pasa las variables $estudiante y $carreras a la vista para que puedan ser usadas allí.
    }
}