<?php

namespace Tests\Feature;

use App\Livewire\Admin\BloqueosManager;
use App\Livewire\Admin\DoctoresManager;
use App\Livewire\Admin\EspecialidadesManager;
use App\Livewire\Admin\HorariosManager;
use App\Livewire\Admin\ServiciosManager;
use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\Horario;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_crea_una_especialidad(): void
    {
        Livewire::test(EspecialidadesManager::class)
            ->call('abrirModal')
            ->set('nombre', 'Oftalmología')
            ->set('descripcion', 'Salud visual.')
            ->call('guardar')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('especialidades', ['nombre' => 'Oftalmología', 'estado' => true]);
    }

    public function test_no_permite_especialidad_duplicada(): void
    {
        Especialidad::create(['nombre' => 'Cardiología', 'estado' => true]);

        Livewire::test(EspecialidadesManager::class)
            ->call('abrirModal')
            ->set('nombre', 'Cardiología')
            ->call('guardar')
            ->assertHasErrors(['nombre' => 'unique']);
    }

    public function test_crea_un_servicio_para_una_especialidad(): void
    {
        $especialidad = Especialidad::create(['nombre' => 'Pediatría', 'estado' => true]);

        Livewire::test(ServiciosManager::class)
            ->call('abrirModal')
            ->set('especialidad_id', (string) $especialidad->id)
            ->set('nombre', 'Consulta pediátrica')
            ->set('requiere_doctor', true)
            ->call('guardar')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('servicios', [
            'especialidad_id' => $especialidad->id,
            'nombre' => 'Consulta pediátrica',
            'requiere_doctor' => true,
        ]);
    }

    public function test_crea_un_doctor_con_especialidades(): void
    {
        $especialidad = Especialidad::create(['nombre' => 'Dermatología', 'estado' => true]);

        Livewire::test(DoctoresManager::class)
            ->call('abrirModal')
            ->set('nombres', 'Lucía')
            ->set('apellidos', 'Salazar')
            ->set('numero_documento', '12345678')
            ->set('especialidades', [$especialidad->id])
            ->call('guardar')
            ->assertHasNoErrors();

        $doctor = Doctor::first();
        $this->assertSame('Lucía Salazar', $doctor->nombre_completo);
        $this->assertTrue($doctor->especialidades->contains($especialidad));
    }

    public function test_horario_exige_doctor_si_el_servicio_lo_requiere(): void
    {
        $especialidad = Especialidad::create(['nombre' => 'Neurología', 'estado' => true]);
        $servicio = Servicio::create([
            'especialidad_id' => $especialidad->id,
            'nombre' => 'Consulta neurológica',
            'requiere_doctor' => true,
            'estado' => true,
        ]);

        Livewire::test(HorariosManager::class)
            ->call('abrirModal')
            ->set('servicio_id', (string) $servicio->id)
            ->set('doctor_id', null)
            ->set('hora_inicio', '08:00')
            ->set('hora_fin', '12:00')
            ->set('frecuencia_minutos', '30')
            ->set('capacidad', '1')
            ->set('dias_semana', [1, 2, 3])
            ->call('guardar')
            ->assertHasErrors('doctor_id');
    }

    public function test_crea_un_horario_con_dias(): void
    {
        $especialidad = Especialidad::create(['nombre' => 'Odontología', 'estado' => true]);
        $servicio = Servicio::create([
            'especialidad_id' => $especialidad->id,
            'nombre' => 'Limpieza dental',
            'requiere_doctor' => false,
            'estado' => true,
        ]);

        Livewire::test(HorariosManager::class)
            ->call('abrirModal')
            ->set('servicio_id', (string) $servicio->id)
            ->set('hora_inicio', '09:00')
            ->set('hora_fin', '13:00')
            ->set('frecuencia_minutos', '20')
            ->set('capacidad', '2')
            ->set('dias_semana', [1, 3, 5])
            ->call('guardar')
            ->assertHasNoErrors();

        $horario = Horario::first();
        $this->assertEqualsCanonicalizing([1, 3, 5], $horario->dias->pluck('dia_semana')->all());
    }

    public function test_horario_guarda_ventana_de_vigencia_y_valida_el_rango(): void
    {
        $especialidad = Especialidad::create(['nombre' => 'Cardiología', 'estado' => true]);
        $servicio = Servicio::create([
            'especialidad_id' => $especialidad->id,
            'nombre' => 'Electrocardiograma',
            'requiere_doctor' => false,
            'estado' => true,
        ]);

        $base = fn () => Livewire::test(HorariosManager::class)
            ->call('abrirModal')
            ->set('servicio_id', (string) $servicio->id)
            ->set('hora_inicio', '08:00')
            ->set('hora_fin', '12:00')
            ->set('frecuencia_minutos', '30')
            ->set('capacidad', '1')
            ->set('dias_semana', [1]);

        // fecha_fin anterior a fecha_inicio → error.
        $base()->set('fecha_inicio', '2027-01-29')
            ->set('fecha_fin', '2027-01-01')
            ->call('guardar')
            ->assertHasErrors('fecha_fin');

        // Ventana válida → se guarda.
        $base()->set('fecha_inicio', '2027-01-01')
            ->set('fecha_fin', '2027-01-29')
            ->call('guardar')
            ->assertHasNoErrors();

        $horario = Horario::latest('id')->first();
        $this->assertSame('2027-01-01', $horario->fecha_inicio->toDateString());
        $this->assertSame('2027-01-29', $horario->fecha_fin->toDateString());
    }

    public function test_horario_rechaza_fin_antes_de_inicio(): void
    {
        $especialidad = Especialidad::create(['nombre' => 'Cardiología', 'estado' => true]);
        $servicio = Servicio::create([
            'especialidad_id' => $especialidad->id,
            'nombre' => 'Electrocardiograma',
            'requiere_doctor' => false,
            'estado' => true,
        ]);

        Livewire::test(HorariosManager::class)
            ->call('abrirModal')
            ->set('servicio_id', (string) $servicio->id)
            ->set('hora_inicio', '12:00')
            ->set('hora_fin', '09:00')
            ->set('frecuencia_minutos', '30')
            ->set('capacidad', '1')
            ->set('dias_semana', [2])
            ->call('guardar')
            ->assertHasErrors(['hora_fin' => 'after']);
    }

    public function test_crea_un_bloqueo_de_horario(): void
    {
        $doctor = Doctor::create([
            'nombres' => 'Jorge',
            'apellidos' => 'Mendoza',
            'estado' => true,
        ]);

        Livewire::test(BloqueosManager::class)
            ->call('abrirModal')
            ->set('doctor_id', (string) $doctor->id)
            ->set('fecha', now()->addWeek()->toDateString())
            ->set('hora_inicio', '08:00')
            ->set('hora_fin', '10:00')
            ->set('motivo', 'Capacitación')
            ->call('guardar')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('bloqueos_horario', [
            'doctor_id' => $doctor->id,
            'motivo' => 'Capacitación',
        ]);
    }
}
