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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            // Add the foreign key for paciente
            $table->foreignId('paciente_id')
                  ->constrained('pacientes') // References the 'pacientes' table
                  ->onDelete('cascade');    // If a patient is deleted, delete their appointments

            // Add the foreign key for medico
            $table->foreignId('medico_id')
                  ->constrained('medicos')    // References the 'medicos' table
                  ->onDelete('cascade');     // If a medico is deleted, delete their appointments

            // Add other necessary columns based on your application logic
            $table->date('fecha');
            $table->time('hora'); // Use time for just the time part
            $table->string('estado', 50)->default('Pendiente'); // e.g., Pendiente, Confirmada, Cancelada

            $table->timestamps(); // Creates created_at and updated_at

            // Optional: Ensure InnoDB engine is used for foreign keys
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};