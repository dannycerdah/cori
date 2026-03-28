<?php

namespace Database\Seeders;

use App\Models\Surgery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurgerySeeder extends Seeder
{
    public function run(): void
    {
        $surgeries = [
            ['nombre' => 'Cesárea', 'descripcion' => 'Atención especializada y segura para partos por cesárea.', 'orden' => 1],
            ['nombre' => 'Parto Vaginal Asistido', 'descripcion' => 'Parto vaginal con asistencia especializada cuando es necesario.', 'orden' => 2],
            ['nombre' => 'Legrado Uterino', 'descripcion' => 'Procedimiento realizado cuando es necesario.', 'orden' => 3],
            ['nombre' => 'Atención de Complicaciones', 'descripcion' => 'Manejo especializado de complicaciones durante el embarazo.', 'orden' => 4],
        ];

        foreach ($surgeries as $surgery) {
            Surgery::create(array_merge($surgery, ['active' => true]));
        }
    }
}

