<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Servicios de ejemplo por especialidad. requiere_doctor indica si la cita
        // de ese servicio necesita un doctor asignado.
        $serviciosPorEspecialidad = [
            'Cardiología' => [
                ['nombre' => 'Consulta cardiológica', 'requiere_doctor' => true],
                ['nombre' => 'Electrocardiograma', 'requiere_doctor' => false],
            ],
            'Pediatría' => [
                ['nombre' => 'Consulta pediátrica', 'requiere_doctor' => true],
                ['nombre' => 'Control de niño sano', 'requiere_doctor' => true],
            ],
            'Dermatología' => [
                ['nombre' => 'Consulta dermatológica', 'requiere_doctor' => true],
            ],
            'Odontología' => [
                ['nombre' => 'Consulta odontológica', 'requiere_doctor' => true],
                ['nombre' => 'Limpieza dental', 'requiere_doctor' => false],
            ],
            'Neurología' => [
                ['nombre' => 'Consulta neurológica', 'requiere_doctor' => true],
            ],
        ];

        foreach ($serviciosPorEspecialidad as $nombreEspecialidad => $servicios) {
            $especialidad = Especialidad::where('nombre', $nombreEspecialidad)->first();

            if (! $especialidad) {
                continue;
            }

            foreach ($servicios as $servicio) {
                Servicio::updateOrCreate(
                    ['especialidad_id' => $especialidad->id, 'nombre' => $servicio['nombre']],
                    [
                        'descripcion' => null,
                        'requiere_doctor' => $servicio['requiere_doctor'],
                        'estado' => true,
                    ]
                );
            }
        }
    }
}
