<?php

namespace Tests\Feature;

use App\Livewire\CitaForm;
use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Horario;
use App\Models\Paciente;
use App\Models\Servicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class CitaFormTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Crea un horario para el servicio válido todos los días de la semana,
     * de 08:00 a 18:00 en franjas de 30 minutos.
     */
    private function crearHorario(Servicio $servicio, int $capacidad = 3): Horario
    {
        $horario = Horario::create([
            'servicio_id' => $servicio->id,
            'doctor_id' => null,
            'hora_inicio' => '08:00',
            'hora_fin' => '18:00',
            'frecuencia_minutos' => 30,
            'capacidad' => $capacidad,
            'estado' => true,
        ]);

        foreach (range(1, 7) as $dia) {
            $horario->dias()->create(['dia_semana' => $dia]);
        }

        return $horario;
    }

    private function crearServicio(): Servicio
    {
        $especialidad = Especialidad::create(['nombre' => 'Cardiología', 'estado' => true]);

        return Servicio::create([
            'especialidad_id' => $especialidad->id,
            'nombre' => 'Consulta cardiológica',
            'requiere_doctor' => false,
            'estado' => true,
        ]);
    }

    public function test_reserva_una_cita_eligiendo_fecha_y_hora_disponibles(): void
    {
        $servicio = $this->crearServicio();
        $horario = $this->crearHorario($servicio);
        $fecha = Carbon::tomorrow()->toDateString();

        Livewire::test(CitaForm::class)
            ->set('tipo_documento', 'DNI')
            ->set('numero_documento', '87654321')
            ->set('paciente_nombres', 'María')
            ->set('paciente_apellidos', 'Pérez')
            ->set('telefono', '999111222')
            ->set('especialidad_id', (string) $servicio->especialidad_id)
            ->set('servicio_id', (string) $servicio->id)
            ->call('elegirFecha', $fecha)
            ->call('elegirHora', '10:00')
            ->call('reservar')
            ->assertHasNoErrors();

        $cita = Cita::first();
        $this->assertSame($servicio->id, $cita->servicio_id);
        $this->assertSame($horario->id, $cita->horario_id);
        $this->assertSame('REGISTRADA', $cita->estado);
        $this->assertSame('10:00', substr($cita->hora_inicio, 0, 5));
        $this->assertSame('10:30', substr($cita->hora_fin, 0, 5));
    }

    public function test_solo_ofrece_fechas_de_dias_con_horario(): void
    {
        $servicio = $this->crearServicio();

        // Horario solo los lunes (día ISO 1).
        $horario = Horario::create([
            'servicio_id' => $servicio->id,
            'hora_inicio' => '09:00',
            'hora_fin' => '12:00',
            'frecuencia_minutos' => 30,
            'capacidad' => 1,
            'estado' => true,
        ]);
        $horario->dias()->create(['dia_semana' => 1]);

        $component = Livewire::test(CitaForm::class)
            ->set('especialidad_id', (string) $servicio->especialidad_id)
            ->set('servicio_id', (string) $servicio->id);

        $fechas = collect($component->instance()->fechasDisponibles);

        $this->assertTrue($fechas->isNotEmpty());
        $fechas->each(fn ($f) => $this->assertSame(1, Carbon::parse($f['fecha'])->isoWeekday()));
    }

    public function test_no_muestra_una_franja_que_ya_alcanzo_su_capacidad(): void
    {
        $servicio = $this->crearServicio();
        $this->crearHorario($servicio, capacidad: 1);
        $fecha = Carbon::tomorrow()->toDateString();

        $paciente = Paciente::create([
            'tipo_documento' => 'DNI',
            'numero_documento' => '10101010',
            'nombres' => 'Otro',
            'apellidos' => 'Paciente',
        ]);

        // Cupo único de las 10:00 ya ocupado.
        Cita::create([
            'paciente_id' => $paciente->id,
            'especialidad_id' => $servicio->especialidad_id,
            'servicio_id' => $servicio->id,
            'fecha' => $fecha,
            'hora_inicio' => '10:00',
            'hora_fin' => '10:30',
            'tipo' => 'NORMAL',
            'estado' => 'REGISTRADA',
        ]);

        $slots = collect(
            Livewire::test(CitaForm::class)
                ->set('especialidad_id', (string) $servicio->especialidad_id)
                ->set('servicio_id', (string) $servicio->id)
                ->call('elegirFecha', $fecha)
                ->instance()
                ->slotsDisponibles
        );

        $this->assertFalse($slots->contains('hora_inicio', '10:00'));
        $this->assertTrue($slots->contains('hora_inicio', '10:30'));
    }

    public function test_reservar_falla_si_la_franja_se_lleno_mientras_tanto(): void
    {
        $servicio = $this->crearServicio();
        $this->crearHorario($servicio, capacidad: 1);
        $fecha = Carbon::tomorrow()->toDateString();

        $component = Livewire::test(CitaForm::class)
            ->set('tipo_documento', 'DNI')
            ->set('numero_documento', '87654321')
            ->set('paciente_nombres', 'María')
            ->set('paciente_apellidos', 'Pérez')
            ->set('telefono', '999111222')
            ->set('especialidad_id', (string) $servicio->especialidad_id)
            ->set('servicio_id', (string) $servicio->id)
            ->call('elegirFecha', $fecha)
            ->call('elegirHora', '10:00');

        // Alguien más reserva las 10:00 antes de confirmar.
        $paciente = Paciente::create([
            'tipo_documento' => 'DNI', 'numero_documento' => '20202020',
            'nombres' => 'Rival', 'apellidos' => 'Veloz',
        ]);
        Cita::create([
            'paciente_id' => $paciente->id,
            'especialidad_id' => $servicio->especialidad_id,
            'servicio_id' => $servicio->id,
            'fecha' => $fecha,
            'hora_inicio' => '10:00',
            'hora_fin' => '10:30',
            'tipo' => 'NORMAL',
            'estado' => 'REGISTRADA',
        ]);

        $component->call('reservar')->assertHasErrors('hora');
        $this->assertSame(1, Cita::count());
    }

    public function test_no_permite_dos_citas_del_mismo_servicio_el_mismo_dia_para_una_persona(): void
    {
        $servicio = $this->crearServicio();
        $this->crearHorario($servicio);
        $fecha = Carbon::tomorrow()->toDateString();

        $paciente = Paciente::create([
            'tipo_documento' => 'DNI',
            'numero_documento' => '87654321',
            'nombres' => 'María',
            'apellidos' => 'Pérez',
            'telefono' => '999111222',
        ]);

        Cita::create([
            'paciente_id' => $paciente->id,
            'especialidad_id' => $servicio->especialidad_id,
            'servicio_id' => $servicio->id,
            'fecha' => $fecha,
            'hora_inicio' => '09:00',
            'hora_fin' => '09:30',
            'tipo' => 'NORMAL',
            'estado' => 'REGISTRADA',
        ]);

        Livewire::test(CitaForm::class)
            ->set('tipo_documento', 'DNI')
            ->set('numero_documento', '87654321')
            ->set('paciente_nombres', 'María')
            ->set('paciente_apellidos', 'Pérez')
            ->set('telefono', '999111222')
            ->set('especialidad_id', (string) $servicio->especialidad_id)
            ->set('servicio_id', (string) $servicio->id)
            ->call('elegirFecha', $fecha)
            ->call('elegirHora', '10:00')
            ->call('reservar')
            ->assertHasErrors('fecha');

        $this->assertSame(1, Cita::count());
    }

    public function test_permite_otra_cita_si_es_otro_dia_u_otro_servicio(): void
    {
        $servicio = $this->crearServicio();
        $otroServicio = Servicio::create([
            'especialidad_id' => $servicio->especialidad_id,
            'nombre' => 'Electrocardiograma',
            'requiere_doctor' => false,
            'estado' => true,
        ]);
        $this->crearHorario($servicio);
        $this->crearHorario($otroServicio);
        $fecha = Carbon::tomorrow()->toDateString();

        $paciente = Paciente::create([
            'tipo_documento' => 'DNI', 'numero_documento' => '87654321',
            'nombres' => 'María', 'apellidos' => 'Pérez', 'telefono' => '999111222',
        ]);
        Cita::create([
            'paciente_id' => $paciente->id,
            'especialidad_id' => $servicio->especialidad_id,
            'servicio_id' => $servicio->id,
            'fecha' => $fecha,
            'hora_inicio' => '09:00', 'hora_fin' => '09:30',
            'tipo' => 'NORMAL', 'estado' => 'REGISTRADA',
        ]);

        // Mismo día pero otro servicio → permitido.
        Livewire::test(CitaForm::class)
            ->set('tipo_documento', 'DNI')
            ->set('numero_documento', '87654321')
            ->set('paciente_nombres', 'María')
            ->set('paciente_apellidos', 'Pérez')
            ->set('telefono', '999111222')
            ->set('especialidad_id', (string) $otroServicio->especialidad_id)
            ->set('servicio_id', (string) $otroServicio->id)
            ->call('elegirFecha', $fecha)
            ->call('elegirHora', '10:00')
            ->call('reservar')
            ->assertHasNoErrors();

        $this->assertSame(2, Cita::count());
    }

    public function test_el_asistente_movil_valida_por_paso_y_reserva(): void
    {
        $servicio = $this->crearServicio();
        $this->crearHorario($servicio);
        $fecha = Carbon::tomorrow()->toDateString();

        $comp = Livewire::test(CitaForm::class);

        $comp->call('siguientePaso')->assertHasErrors(['tipo_documento', 'numero_documento'])
            ->assertSet('pasoActual', 1);

        $comp->set('tipo_documento', 'DNI')
            ->set('numero_documento', '55667788')
            ->set('paciente_nombres', 'Rosa')
            ->set('paciente_apellidos', 'Díaz')
            ->set('telefono', '955555555')
            ->call('siguientePaso')->assertHasNoErrors()->assertSet('pasoActual', 2);

        $comp->set('especialidad_id', (string) $servicio->especialidad_id)
            ->set('servicio_id', (string) $servicio->id)
            ->call('siguientePaso')->assertSet('pasoActual', 3)
            ->call('elegirFecha', $fecha)
            ->call('elegirHora', '11:30')
            ->call('siguientePaso')->assertSet('pasoActual', 4);

        $comp->call('reservar')->assertHasNoErrors();

        $this->assertDatabaseHas('citas', ['servicio_id' => $servicio->id, 'hora_inicio' => '11:30']);
        $comp->assertSet('pasoActual', 1);
    }

    public function test_el_servicio_es_obligatorio(): void
    {
        $especialidad = Especialidad::create(['nombre' => 'Pediatría', 'estado' => true]);

        Livewire::test(CitaForm::class)
            ->set('tipo_documento', 'DNI')
            ->set('numero_documento', '11223344')
            ->set('paciente_nombres', 'Ana')
            ->set('paciente_apellidos', 'Gómez')
            ->set('telefono', '900000000')
            ->set('especialidad_id', (string) $especialidad->id)
            ->set('fecha', Carbon::tomorrow()->toDateString())
            ->set('hora', '09:00')
            ->call('reservar')
            ->assertHasErrors('servicio_id');
    }
}
