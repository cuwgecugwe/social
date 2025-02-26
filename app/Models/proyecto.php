<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    use HasFactory;
    protected $fillable = [
        'estudiante_id',
        'nombre_proyecto',
        'descripcion',
        'fecha',
        'hora',
        
    ];
    public function estudiantes()
    {
        // Define una relación "pertenece a" (belongsTo) con el modelo 'estudiante'.
        // Esto significa que un estudiante pertenece a una estudiante.
        return $this->belongsTo(estudiante::class, 'estudiante_id');
        // 'estudiante_id' es la clave foránea que conecta esta tabla con la tabla 'estudiantes'.
    }

}