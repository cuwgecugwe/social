<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrera extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_carrera',
        'abreviatura',
        
    ];
    public function estudiantes()
    {
        // Define una relación "pertenece a" (belongsTo) con el modelo 'Carrera'.
        // Esto significa que un estudiante pertenece a una carrera.
        return $this->hasMany(estudiante::class, 'carrera_id');
        // 'carrera_id' es la clave foránea que conecta esta tabla con la tabla 'carreras'.
    }
}
