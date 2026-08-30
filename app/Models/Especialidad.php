<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    public function doctores()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_especialidades')
            ->withPivot('estado')
            ->withTimestamps();
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
