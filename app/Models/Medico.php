<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medicos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombres',
        'apellidos',
        'tarjeta_profesional',
        'telefono',
        'email',
        'consultorio',
        'especialidad_id',
    ];

    /**
     * Get the especialidad that owns the medico.
     */
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    /**
     * Get the citas for the medico.
     */
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}