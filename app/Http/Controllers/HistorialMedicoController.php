<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HistorialMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historial = HistorialMedico::all();
        return response()->json($historial);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id', // Debe existir un paciente con este ID
            'fecha_registro' => 'required|date',
            'descripcion' => 'required|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
        ]);

        $historial = HistorialMedico::create($validatedData);
        return response()->json($historial, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(HistorialMedico $historialMedico)
    {
        // Opcional: Cargar la relación con el paciente
        $historialMedico->load('paciente');
        return response()->json($historialMedico);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistorialMedico $historialMedico)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_registro' => 'required|date',
            'descripcion' => 'required|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
        ]);

        $historialMedico->update($validatedData);
        return response()->json($historialMedico);
    }


    public function destroy(HistorialMedico $historialMedico)
    {
        $historialMedico->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }



    public function getHistorialByPaciente($pacienteId)
    {
        $historial = HistorialMedico::where('paciente_id', $pacienteId)->get();
        return response()->json($historial);
    }
}