<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'especialidad_id',
        'nombre',
        'descripcion',
        'requiere_doctor',
        'estado',
    ];

    protected $casts = [
        'requiere_doctor' => 'boolean',
        'estado' => 'boolean',
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
