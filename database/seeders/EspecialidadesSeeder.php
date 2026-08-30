<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidades = [
            ['nombre' => 'Cardiología', 'descripcion' => 'Atención integral del corazón.'],
            ['nombre' => 'Pediatría', 'descripcion' => 'Salud infantil y adolescente.'],
            ['nombre' => 'Dermatología', 'descripcion' => 'Cuidado de la piel.'],
            ['nombre' => 'Odontología', 'descripcion' => 'Atención dental y oral.'],
            ['nombre' => 'Neurología', 'descripcion' => 'Diagnóstico y tratamiento de trastornos del sistema nervioso.'],
        ];

        foreach ($especialidades as $especialidad) {
            Especialidad::updateOrCreate(
                ['nombre' => $especialidad['nombre']],
                ['descripcion' => $especialidad['descripcion'], 'estado' => true]
            );
        }
    }
}
