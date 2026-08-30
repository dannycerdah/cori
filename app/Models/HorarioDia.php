<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioDia extends Model
{
    use HasFactory;

    protected $table = 'horario_dias';

    protected $fillable = [
        'horario_id',
        'dia_semana',
    ];

    protected $casts = [
        'dia_semana' => 'integer',
    ];

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }
}
