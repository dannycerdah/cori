<?php

namespace Database\Seeders;

use App\Models\Ecografia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcografiaSeeder extends Seeder
{
    public function run(): void
    {
        $ecografias = [
            ['nombre' => 'Ecografía Primer Trimestre', 'descripcion' => 'Evaluación de viabilidad fetal y mediciones iniciales.', 'orden' => 1],
            ['nombre' => 'Ecografía Morfológica', 'descripcion' => 'Estudio detallado de estructuras fetales en segundo trimestre.', 'orden' => 2],
            ['nombre' => 'Ecografía Tercer Trimestre', 'descripcion' => 'Crecimiento fetal y evaluación previa al parto.', 'orden' => 3],
            ['nombre' => 'Ecografía Doppler', 'descripcion' => 'Evaluación del flujo sanguíneo fetal.', 'orden' => 4],
        ];

        foreach ($ecografias as $ecografia) {
            Ecografia::create(array_merge($ecografia, ['active' => true]));
        }
    }
}

