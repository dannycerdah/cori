<?php

namespace Database\Seeders;

use App\Models\ContentSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSectionSeeder extends Seeder
{
    public function run(): void
    {
        ContentSection::updateOrCreate(
            ['key' => 'about_clinica'],
            [
                'tipo' => 'about',
                'contenido' => 'Clínica especializada en atención integral de gestantes y control de embarazo con un equipo de profesionales altamente capacitados en obstetricia. Ofrecemos un ambiente acogedor y tecnología de punta para acompañar a las futuras madres en cada etapa de su embarazo.',
                'active' => true,
            ]
        );

        ContentSection::updateOrCreate(
            ['key' => 'contact_address'],
            [
                'tipo' => 'contact',
                'contenido' => 'Los Olivos - Av. Carlos Izaguirre 978',
                'active' => true,
            ]
        );

        ContentSection::updateOrCreate(
            ['key' => 'contact_reference'],
            [
                'tipo' => 'contact',
                'contenido' => 'A media cuadra de la Municipalidad de Los Olivos',
                'active' => true,
            ]
        );

        ContentSection::updateOrCreate(
            ['key' => 'contact_phone'],
            [
                'tipo' => 'contact',
                'contenido' => '964 278 433 / 939 220 356',
                'active' => true,
            ]
        );

        ContentSection::updateOrCreate(
            ['key' => 'contact_email'],
            [
                'tipo' => 'contact',
                'contenido' => 'info@clinicacori.com',
                'active' => true,
            ]
        );
    }
}

