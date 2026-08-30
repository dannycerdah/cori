<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctores = [
            [
                'nombres' => 'Ana María',
                'apellidos' => 'Torres Quispe',
                'tipo_documento' => 'DNI',
                'numero_documento' => '40011223',
                'telefono' => '987654321',
                'correo' => 'ana.torres@clinicacori.com',
                'especialidades' => ['Cardiología'],
            ],
            [
                'nombres' => 'Carlos Alberto',
                'apellidos' => 'Ramírez Flores',
                'tipo_documento' => 'DNI',
                'numero_documento' => '40233445',
                'telefono' => '987112233',
                'correo' => 'carlos.ramirez@clinicacori.com',
                'especialidades' => ['Pediatría'],
            ],
            [
                'nombres' => 'Lucía Fernanda',
                'apellidos' => 'Salazar Núñez',
                'tipo_documento' => 'DNI',
                'numero_documento' => '40455667',
                'telefono' => '987445566',
                'correo' => 'lucia.salazar@clinicacori.com',
                'especialidades' => ['Dermatología', 'Neurología'],
            ],
            [
                'nombres' => 'Jorge Luis',
                'apellidos' => 'Mendoza Rojas',
                'tipo_documento' => 'DNI',
                'numero_documento' => '40677889',
                'telefono' => '987778899',
                'correo' => 'jorge.mendoza@clinicacori.com',
                'especialidades' => ['Odontología'],
            ],
        ];

        foreach ($doctores as $datos) {
            $especialidades = $datos['especialidades'];
            unset($datos['especialidades']);

            $doctor = Doctor::updateOrCreate(
                ['numero_documento' => $datos['numero_documento']],
                array_merge($datos, ['estado' => true])
            );

            $ids = Especialidad::whereIn('nombre', $especialidades)->pluck('id')->all();
            $doctor->especialidades()->sync(
                collect($ids)->mapWithKeys(fn ($id) => [$id => ['estado' => true]])->all()
            );
        }
    }
}
