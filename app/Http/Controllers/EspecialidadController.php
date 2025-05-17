<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; // Import DB Facade for custom queries

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidades = Especialidad::all();
        return response()->json($especialidades);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|unique:especialidades|max:255',
            'descripcion' => 'nullable|string', // <-- Changed from 'text' to 'string'
        ]);

        $especialidad = Especialidad::create($validatedData);
        return response()->json($especialidad, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Especialidad $especialidad)
    {
        // You might want to load related doctors here
        // $especialidad->load('medicos');
        return response()->json($especialidad);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialidad $especialidad)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|unique:especialidades,nombre,' . $especialidad->id . '|max:255',
            'descripcion' => 'nullable|string', // <-- Changed from 'text' to 'string'
        ]);

        $especialidad->update($validatedData);
        return response()->json($especialidad);
    }

    
     
     
    public function destroy(Especialidad $especialidad)
    {
        $especialidad->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    

    public function getEspecialidadWithDoctorCount(Especialidad $especialidad)
    {
        $especialidadWithCount = $especialidad->loadCount('medicos'); 
        return response()->json($especialidadWithCount);
    }
}