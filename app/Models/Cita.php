<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'citas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'paciente_id', // Assuming this field exists based on requirements
        'medico_id',   // Assuming this field exists based on requirements
        'fecha',
        'hora',
        'estado',
        // Add any other fillable fields from your citas table migration
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'hora' => 'datetime:H:i', // Casting hour to specific format
        ];
    }

    /**
     * Get the paciente that owns the cita.
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    /**
     * Get the medico that owns the cita.
     */
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}