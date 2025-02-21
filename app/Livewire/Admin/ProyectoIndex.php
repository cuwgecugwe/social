<?php

namespace App\Livewire\Admin;

use App\Models\estudiante;
use App\Models\proyecto;
use Livewire\Component;

class ProyectoIndex extends Component
{
    public function render()
    {
        $proyecto = proyecto::all();
        $estudiante=estudiante::all();
        return view('livewire.admin.proyecto-index',compact('proyecto','estudiante'));
    }
}
