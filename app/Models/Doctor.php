<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctores';

    protected $fillable = [
        'nombres',
        'apellidos',
        'tipo_documento',
        'numero_documento',
        'telefono',
        'correo',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    /**
     * Nombre completo del doctor para mostrar en listados y selects.
     */
    protected function nombreCompleto(): Attribute
    {
        return Attribute::get(fn () => trim("{$this->nombres} {$this->apellidos}"));
    }

    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'doctor_especialidades')
            ->withPivot('estado')
            ->withTimestamps();
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function bloqueos()
    {
        return $this->hasMany(BloqueoHorario::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
