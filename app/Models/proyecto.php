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
        // Define una relación "pertenece a" (belongsTo) con el modelo 'estudinate'.
        // Esto significa que un estudiante pertenece a una estudinate.
        return $this->belongsTo(estudiante::class, 'estudinate_id');
        // 'estudinate_id' es la clave foránea que conecta esta tabla con la tabla 'estudinates'.
    }

}
