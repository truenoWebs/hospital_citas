<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; // Import DB Facade for custom queries

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load the specialty relationship for better performance
        $medicos = Medico::with('especialidad')->get();
        return response()->json($medicos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_documento' => 'required|string|max:20',
            'numero_documento' => 'required|string|unique:medicos|max:255', // Assuming max 255 for string
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tarjeta_profesional' => 'required|string|unique:medicos|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|string|email|unique:medicos|max:255',
            'consultorio' => 'nullable|string|max:255',
            'especialidad_id' => 'nullable|exists:especialidades,id',
        ]);

        $medico = Medico::create($validatedData);
        return response()->json($medico, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Medico $medico)
    {
        // Eager load the specialty relationship
        $medico->load('especialidad');
        return response()->json($medico);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medico $medico)
    {
        $validatedData = $request->validate([
            'tipo_documento' => 'required|string|max:20',
            'numero_documento' => 'required|string|unique:medicos,numero_documento,' . $medico->id . '|max:255',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tarjeta_profesional' => 'required|string|unique:medicos,tarjeta_profesional,' . $medico->id . '|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|string|email|unique:medicos,email,' . $medico->id . '|max:255',
            'consultorio' => 'nullable|string|max:255',
            'especialidad_id' => 'nullable|exists:especialidades,id',
        ]);

        $medico->update($validatedData);
        return response()->json($medico);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $medico)
    {
        // Consider if you need to handle related appointments before deleting a doctor.
        $medico->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    
    public function getMedicosByEspecialidad($especialidadId)
    {
        $medicos = Medico::where('especialidad_id', $especialidadId)->get();
        return response()->json($medicos);
    }
}