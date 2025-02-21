<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crea una nueva tabla llamada 'estudiantes' en la base de datos.
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id(); // Agrega un campo 'id' como clave primaria autoincremental.
            $table->string('dni')->unique(); // Agrega un campo 'dni' de tipo string que debe ser único.
            $table->string('nombre'); // Agrega un campo 'nombre' de tipo string.
            $table->unsignedBigInteger('carrera_id'); // Agrega un campo 'carrera_id' para relacionar con la tabla 'carreras'.
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade'); 
            // Define una relación: 'carrera_id' hace referencia al campo 'id' en la tabla 'carreras'.
            // Si se elimina una carrera, todos los estudiantes relacionados también se eliminarán ('onDelete cascade').
            $table->string('apellido'); // Agrega un campo 'apellido' de tipo string.
            $table->string('promocion'); // Agrega un campo 'promocion' de tipo string.
            $table->timestamps(); // Agrega dos campos: 'created_at' y 'updated_at' para registrar fechas de creación y actualización.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
