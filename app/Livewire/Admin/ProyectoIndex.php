<?php

namespace App\Livewire\Admin;

use App\Models\proyecto;
use Livewire\Component;

class ProyectoIndex extends Component
{
    public function render()
    {
        $proyecto = proyecto::all();
        return view('livewire.admin.proyecto-index',compact('proyecto'));
    }
}
