<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; // Import DB Facade for custom queries

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::all();
        return response()->json($citas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Assuming 'citas' table has 'paciente_id', 'medico_id', 'fecha', 'hora', 'estado'
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'estado' => 'required|string|max:50', // e.g., Pendiente, Confirmada, Cancelada
            // Add other relevant fields from your citas migration
        ]);

        $cita = Cita::create($validatedData);
        return response()->json($cita, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        // You might want to load relationships here if they exist in your Cita model
        // $cita->load(['paciente', 'medico']);
        return response()->json($cita);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'estado' => 'required|string|max:50',
            // Add other relevant fields from your citas migration
        ]);

        $cita->update($validatedData);
        return response()->json($cita);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        $cita->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }


    public function getCitasByPaciente($pacienteId)
    {
        $citas = Cita::where('paciente_id', $pacienteId)->get();
        return response()->json($citas);
    }


    public function getPendingCitasByDate($date)
    {
        $citas = Cita::where('fecha', $date)
                     ->where('estado', 'Pendiente')
                     ->get();
        return response()->json($citas);
    }
}