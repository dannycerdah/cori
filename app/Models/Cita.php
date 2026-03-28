<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\Especialidad;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'paciente_id',
        'especialidad_id',
        'fecha',
        'hora',
        'estado',
        'notas',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
