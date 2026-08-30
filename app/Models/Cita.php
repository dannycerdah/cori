<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'paciente_id',
        'especialidad_id',
        'servicio_id',
        'doctor_id',
        'horario_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'tipo',
        'estado',
        'observacion',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }
}
