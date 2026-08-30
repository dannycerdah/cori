<?php

namespace App\Support;

use App\Models\BloqueoHorario;
use App\Models\Cita;
use App\Models\Horario;
use App\Models\Servicio;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Calcula la disponibilidad de citas de un servicio a partir de sus horarios:
 * qué fechas tienen cupo y qué franjas horarias siguen libres según la
 * capacidad de cada horario y las citas ya registradas.
 */
class DisponibilidadCitas
{
    /**
     * Estados de cita que consumen un cupo (los cancelados / no asistió no cuentan).
     */
    private const ESTADOS_OCUPAN = ['REGISTRADA', 'CONFIRMADA', 'ATENDIDA'];

    public function __construct(
        private int $diasVentana = 15,
    ) {}

    /**
     * Fechas con al menos un cupo libre para el servicio, desde hoy hasta
     * hoy + $diasVentana.
     *
     * @return list<array{fecha: string, etiqueta: string, cupos: int}>
     */
    public function fechasDisponibles(Servicio $servicio): array
    {
        $desde = Carbon::today();
        $hasta = $desde->copy()->addDays($this->diasVentana);

        $contexto = $this->cargarContexto($servicio, $desde->toDateString(), $hasta->toDateString());

        $fechas = [];

        for ($dia = $desde->copy(); $dia->lte($hasta); $dia->addDay()) {
            $slots = $this->slotsParaFecha($dia->copy(), $contexto);

            if ($slots === []) {
                continue;
            }

            $fechas[] = [
                'fecha' => $dia->toDateString(),
                'etiqueta' => $this->etiquetaFecha($dia),
                'cupos' => array_sum(array_column($slots, 'cupos')),
            ];
        }

        return $fechas;
    }

    /**
     * Franjas horarias libres para el servicio en una fecha concreta.
     *
     * @return list<array{hora_inicio: string, hora_fin: string, horario_id: int, doctor_id: int|null, capacidad: int, cupos: int}>
     */
    public function slotsDisponibles(Servicio $servicio, string $fecha): array
    {
        $contexto = $this->cargarContexto($servicio, $fecha, $fecha);

        return $this->slotsParaFecha(Carbon::parse($fecha), $contexto);
    }

    /**
     * Devuelve el slot si la hora indicada sigue teniendo cupo, o null si ya no.
     *
     * @return array{hora_inicio: string, hora_fin: string, horario_id: int, doctor_id: int|null, capacidad: int, cupos: int}|null
     */
    public function slotSigueDisponible(Servicio $servicio, string $fecha, string $hora): ?array
    {
        foreach ($this->slotsDisponibles($servicio, $fecha) as $slot) {
            if ($slot['hora_inicio'] === $hora) {
                return $slot;
            }
        }

        return null;
    }

    /**
     * Precarga en una sola pasada los horarios, las citas y los bloqueos del
     * rango, para no golpear la base de datos día por día.
     *
     * @return array{horarios: Collection<int, Horario>, ocupacion: Collection<string, Collection<string, int>>, bloqueos: Collection<string, Collection<int, BloqueoHorario>>}
     */
    private function cargarContexto(Servicio $servicio, string $desde, string $hasta): array
    {
        $horarios = Horario::query()
            ->where('servicio_id', $servicio->id)
            ->where('estado', true)
            ->where(fn ($q) => $q->whereNull('fecha_inicio')->orWhereDate('fecha_inicio', '<=', $hasta))
            ->where(fn ($q) => $q->whereNull('fecha_fin')->orWhereDate('fecha_fin', '>=', $desde))
            ->with('dias')
            ->get();

        $ocupacion = Cita::query()
            ->where('servicio_id', $servicio->id)
            ->whereDate('fecha', '>=', $desde)
            ->whereDate('fecha', '<=', $hasta)
            ->whereIn('estado', self::ESTADOS_OCUPAN)
            ->get(['fecha', 'hora_inicio'])
            ->groupBy(fn (Cita $cita) => $cita->fecha->toDateString())
            ->map(fn (Collection $delDia) => $delDia->countBy(fn (Cita $cita) => substr((string) $cita->hora_inicio, 0, 5)));

        $doctorIds = $horarios->pluck('doctor_id')->filter()->unique()->values();

        $bloqueos = $doctorIds->isEmpty()
            ? collect()
            : BloqueoHorario::query()
                ->whereIn('doctor_id', $doctorIds)
                ->where('estado', true)
                ->whereDate('fecha', '>=', $desde)
                ->whereDate('fecha', '<=', $hasta)
                ->get(['doctor_id', 'fecha', 'hora_inicio', 'hora_fin'])
                ->groupBy(fn (BloqueoHorario $b) => $b->doctor_id.'|'.$b->fecha->toDateString());

        return compact('horarios', 'ocupacion', 'bloqueos');
    }

    /**
     * @param  array{horarios: Collection, ocupacion: Collection, bloqueos: Collection}  $contexto
     * @return list<array{hora_inicio: string, hora_fin: string, horario_id: int, doctor_id: int|null, capacidad: int, cupos: int}>
     */
    private function slotsParaFecha(Carbon $dia, array $contexto): array
    {
        $fecha = $dia->toDateString();
        $diaSemana = $dia->isoWeekday();
        $esHoy = $dia->isToday();
        $ahora = Carbon::now()->format('H:i');

        $ocupacionDia = $contexto['ocupacion']->get($fecha, collect());

        $porInicio = [];

        foreach ($contexto['horarios'] as $horario) {
            if (! $this->horarioAplicaEnFecha($horario, $fecha, $diaSemana)) {
                continue;
            }

            $bloqueos = $horario->doctor_id
                ? $contexto['bloqueos']->get($horario->doctor_id.'|'.$fecha, collect())
                : collect();

            foreach ($this->generarSlots($horario, $dia) as [$horaInicio, $horaFin]) {
                if ($esHoy && $horaInicio <= $ahora) {
                    continue;
                }

                if ($this->slotBloqueado($bloqueos, $horaInicio, $horaFin)) {
                    continue;
                }

                $cupos = $horario->capacidad - (int) $ocupacionDia->get($horaInicio, 0);

                if ($cupos <= 0) {
                    continue;
                }

                // Si dos horarios generan la misma hora, se conserva el de mayor capacidad.
                if (isset($porInicio[$horaInicio]) && $porInicio[$horaInicio]['capacidad'] >= $horario->capacidad) {
                    continue;
                }

                $porInicio[$horaInicio] = [
                    'hora_inicio' => $horaInicio,
                    'hora_fin' => $horaFin,
                    'horario_id' => $horario->id,
                    'doctor_id' => $horario->doctor_id,
                    'capacidad' => $horario->capacidad,
                    'cupos' => $cupos,
                ];
            }
        }

        ksort($porInicio);

        return array_values($porInicio);
    }

    private function horarioAplicaEnFecha(Horario $horario, string $fecha, int $diaSemana): bool
    {
        if ($horario->fecha_inicio && $horario->fecha_inicio->toDateString() > $fecha) {
            return false;
        }

        if ($horario->fecha_fin && $horario->fecha_fin->toDateString() < $fecha) {
            return false;
        }

        return $horario->dias->contains('dia_semana', $diaSemana);
    }

    /**
     * @return list<array{0: string, 1: string}>
     */
    private function generarSlots(Horario $horario, Carbon $dia): array
    {
        $base = $dia->toDateString();
        $fin = Carbon::parse($base.' '.$horario->hora_fin);
        $frecuencia = max(1, (int) $horario->frecuencia_minutos);

        $slots = [];
        $cursor = Carbon::parse($base.' '.$horario->hora_inicio);

        while ($cursor->copy()->addMinutes($frecuencia)->lte($fin)) {
            $slotFin = $cursor->copy()->addMinutes($frecuencia);
            $slots[] = [$cursor->format('H:i'), $slotFin->format('H:i')];
            $cursor = $slotFin;
        }

        return $slots;
    }

    /**
     * @param  Collection<int, BloqueoHorario>  $bloqueos
     */
    private function slotBloqueado(Collection $bloqueos, string $horaInicio, string $horaFin): bool
    {
        foreach ($bloqueos as $bloqueo) {
            $bloqueoInicio = substr((string) $bloqueo->hora_inicio, 0, 5);
            $bloqueoFin = substr((string) $bloqueo->hora_fin, 0, 5);

            // Se solapan si empieza antes de que acabe el bloqueo y acaba después de que empiece.
            if ($bloqueoInicio < $horaFin && $bloqueoFin > $horaInicio) {
                return true;
            }
        }

        return false;
    }

    private function etiquetaFecha(Carbon $dia): string
    {
        // p. ej. "vie. 5 ene." → "Vie. 5 ene."
        return ucfirst($dia->locale('es')->isoFormat('ddd D MMM'));
    }
}
