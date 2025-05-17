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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id(); // BigInt Unsigned, Primary Key, Auto-increment
            $table->string('tipo_documento', 20); // Ej: CC, TI, CE
            $table->string('numero_documento')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('fecha_nacimiento');
            $table->string('genero', 20)->nullable(); // Podrías usar un enum si los valores son fijos
            $table->string('telefono', 20)->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('direccion')->nullable();
            $table->timestamps(); // Crea created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
