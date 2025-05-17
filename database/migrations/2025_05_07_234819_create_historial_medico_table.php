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
        Schema::create('historial_medico', function (Blueprint $table) {
            $table->id(); // Columna ID auto-incrementable

            // Clave foránea que referencia a la tabla 'pacientes'
            $table->foreignId('paciente_id')
                  ->constrained('pacientes') // Se enlaza con la tabla 'pacientes'
                  ->onDelete('cascade');    // Si se borra un paciente, se borra su historial

            // Otras columnas para el historial médico
            $table->date('fecha_registro');
            $table->text('descripcion'); // Descripción del evento médico o consulta
            $table->string('diagnostico')->nullable(); // Diagnóstico (si aplica)
            $table->text('tratamiento')->nullable(); // Tratamiento (si aplica)

            $table->timestamps(); // Columnas created_at y updated_at

            // Opcional: Asegurar el motor InnoDB si no es el predeterminado
            $table->engine = 'InnoDB';
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('historial_medico');
    }

};
