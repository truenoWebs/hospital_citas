<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'historial_medico';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'paciente_id',
        'fecha_registro',
        'descripcion',
        'diagnostico',
        'tratamiento',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_registro' => 'date',
        ];
    }

    /**
     * Get the paciente that owns the medical history record.
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}