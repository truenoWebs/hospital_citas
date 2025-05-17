<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.  
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidades', function (Blueprint $table) {
            $table->id(); // BigInt Unsigned, Primary Key, Auto-increment
            $table->string('nombre')->unique(); // Nombre de la especialidad, ej: Cardiología, Pediatría
            $table->text('descripcion')->nullable(); // Descripción opcional de la especialidad
            $table->timestamps(); // Crea created_at y updated_at
            $table->engine = 'InnoDB'; // Ensure InnoDB is used
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidades');
    }
};