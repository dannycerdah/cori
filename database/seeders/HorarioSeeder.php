<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Servicio;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Un horario de ejemplo por servicio, de lunes a viernes (días 1..5),
        // en franja de mañana, con slots de 30 minutos.
        $servicios = Servicio::with('especialidad')->get();

        foreach ($servicios as $servicio) {
            $doctorId = null;

            if ($servicio->requiere_doctor) {
                $doctorId = Doctor::whereHas('especialidades', function ($query) use ($servicio) {
                    $query->where('especialidades.id', $servicio->especialidad_id);
                })->value('id');
            }

            $horario = Horario::updateOrCreate(
                ['servicio_id' => $servicio->id, 'doctor_id' => $doctorId],
                [
                    'hora_inicio' => '08:00:00',
                    'hora_fin' => '13:00:00',
                    'frecuencia_minutos' => 30,
                    'capacidad' => 1,
                    'estado' => true,
                ]
            );

            $horario->dias()->delete();

            foreach ([1, 2, 3, 4, 5] as $dia) {
                $horario->dias()->create(['dia_semana' => $dia]);
            }
        }
    }
}
