<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = [
        'servicio_id',
        'doctor_id',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'frecuencia_minutos',
        'capacidad',
        'estado',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'frecuencia_minutos' => 'integer',
        'capacidad' => 'integer',
        'estado' => 'boolean',
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function dias()
    {
        return $this->hasMany(HorarioDia::class);
    }
}
