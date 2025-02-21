<?php

namespace App\Livewire\Admin;

use App\Models\carrera;
use Livewire\Component;

class CarreraIndex extends Component
{
    public function render()
    {
        $carrera = carrera::all();
        return view('livewire.admin.carrera-index',compact('carrera'));
    }
}
