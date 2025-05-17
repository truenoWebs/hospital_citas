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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 20);
            $table->string('numero_documento')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('tarjeta_profesional')->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('email')->unique();
            $table->string('consultorio')->nullable();

            // NUEVA CLAVE FORÁNEA
            $table->foreignId('especialidad_id')
                  ->nullable() // Un médico podría no tener una especialidad asignada inicialmente
                  ->constrained('especialidades') // Se enlaza con la tabla 'especialidades'
                  ->onUpdate('cascade')
                  ->onDelete('set null'); // Si se borra una especialidad, el campo en medicos se pone a null.

            $table->timestamps();
            $table->engine = 'InnoDB'; // Ensure InnoDB is used
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};