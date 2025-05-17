<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; // Import DB Facade for custom queries

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_documento' => 'required|string|max:20',
            'numero_documento' => 'required|string|unique:pacientes|max:255', // Assuming max 255 for string
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|unique:pacientes|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $paciente = Paciente::create($validatedData);
        return response()->json($paciente, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        // You might want to load related appointments here
        // $paciente->load('citas');
        return response()->json($paciente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $validatedData = $request->validate([
            'tipo_documento' => 'required|string|max:20',
            'numero_documento' => 'required|string|unique:pacientes,numero_documento,' . $paciente->id . '|max:255',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|unique:pacientes,email,' . $paciente->id . '|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $paciente->update($validatedData);
        return response()->json($paciente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        // Consider if you need to handle related appointments before deleting a patient.
        $paciente->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    // Compounded Query 5: Get patients born before a specific date, ordered by birth date
    public function getPatientsBornBeforeDate($date)
    {
        $pacientes = Paciente::where('fecha_nacimiento', '<', $date)
                             ->orderBy('fecha_nacimiento')
                             ->get();
        return response()->json($pacientes);
    }
}