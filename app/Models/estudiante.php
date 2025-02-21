<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudiante extends Model
{
    use HasFactory; 
    // Usa el trait 'HasFactory' para habilitar la funcionalidad de fábricas (factory) en este modelo.

    protected $fillable = [
        'dni',         // Permite que estos campos sean asignables masivamente al crear un registro.
        'nombre',      // Ejemplo: Puedes usar `Estudiante::create([...])` con estos campos.
        'apellido',
        'promocion',
        'carrera_id',
    ];

    public function carrera()
    {
        // Define una relación "pertenece a" (belongsTo) con el modelo 'Carrera'.
        // Esto significa que un estudiante pertenece a una carrera.
        return $this->belongsTo(carrera::class, 'carrera_id');
        // 'carrera_id' es la clave foránea que conecta esta tabla con la tabla 'carreras'.
    }
    public function proyectos()
    {
        // Define una relación "pertenece a" (belongsTo) con el modelo 'Carrera'.
        // Esto significa que un estudiante pertenece a una carrera.
        return $this->hasMany(proyecto::class, 'estudiante_id');
        // 'carrera_id' es la clave foránea que conecta esta tabla con la tabla 'carreras'.
    }
}
