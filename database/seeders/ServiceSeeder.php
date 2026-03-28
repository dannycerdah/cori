<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['nombre' => 'Control Prenatal', 'descripcion' => 'Seguimiento integral durante el embarazo con evaluaciones periódicas.', 'orden' => 1],
            ['nombre' => 'Atención del Parto', 'descripcion' => 'Atención especializada y humanizada en el parto.', 'orden' => 2],
            ['nombre' => 'Cuidado Postparto', 'descripcion' => 'Seguimiento y apoyo en el puerperio.', 'orden' => 3],
            ['nombre' => 'Ecografía Obstétrica', 'descripcion' => 'Tecnología de punta para diagnósticos precisos.', 'orden' => 4],
            ['nombre' => 'Laboratorio', 'descripcion' => 'Análisis clínicos para gestantes.', 'orden' => 5],
            ['nombre' => 'Asesoramiento Nutricional', 'descripcion' => 'Orientación nutricional especializada en embarazo.', 'orden' => 6],
        ];

        foreach ($services as $service) {
            Service::create(array_merge($service, ['active' => true]));
        }
    }
}

