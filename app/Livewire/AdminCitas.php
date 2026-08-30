<?php

namespace App\Livewire;

use App\Models\Cita;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCitas extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    /**
     * Estados posibles de una cita (deben coincidir con el enum de la tabla).
     */
    public const ESTADOS = ['REGISTRADA', 'CONFIRMADA', 'ATENDIDA', 'CANCELADA', 'NO_ASISTIO'];

    public $filtroEstado = '';

    public $fechaInicio = '';

    public $fechaFin = '';

    public function mount()
    {
        // En la carga inicial ambas fechas son el día de hoy
        $hoy = Carbon::today()->toDateString();
        $this->fechaInicio = $hoy;
        $this->fechaFin = $hoy;
    }

    public function updatedFiltroEstado()
    {
        $this->resetPage();
    }

    public function updatedFechaInicio()
    {
        $this->resetPage();
    }

    public function updatedFechaFin()
    {
        $this->resetPage();
    }

    public function getResumenProperty()
    {
        // Conteo por estado dentro del rango de fechas (ignora el filtro de estado
        // para mostrar siempre el desglose completo del período).
        $base = Cita::query();

        if ($this->fechaInicio) {
            $base->whereDate('fecha', '>=', $this->fechaInicio);
        }

        if ($this->fechaFin) {
            $base->whereDate('fecha', '<=', $this->fechaFin);
        }

        $porEstado = (clone $base)
            ->selectRaw('estado, count(*) as total')
            ->groupBy('estado')
            ->pluck('total', 'estado');

        return [
            'total' => (int) $porEstado->sum(),
            'REGISTRADA' => (int) ($porEstado['REGISTRADA'] ?? 0),
            'CONFIRMADA' => (int) ($porEstado['CONFIRMADA'] ?? 0),
            'ATENDIDA' => (int) ($porEstado['ATENDIDA'] ?? 0),
            'CANCELADA' => (int) ($porEstado['CANCELADA'] ?? 0),
            'NO_ASISTIO' => (int) ($porEstado['NO_ASISTIO'] ?? 0),
        ];
    }

    public function getCitasProperty()
    {
        $query = Cita::with('paciente', 'especialidad', 'servicio', 'doctor')
            ->orderBy('fecha')
            ->orderBy('hora_inicio');

        if ($this->filtroEstado) {
            $query->where('estado', $this->filtroEstado);
        }

        if ($this->fechaInicio) {
            $query->whereDate('fecha', '>=', $this->fechaInicio);
        }

        if ($this->fechaFin) {
            $query->whereDate('fecha', '<=', $this->fechaFin);
        }

        return $query->paginate(15);
    }

    public function actualizarEstado(Cita $cita, $estado)
    {
        if (! in_array($estado, self::ESTADOS, true)) {
            return;
        }

        $cita->update(['estado' => $estado]);
        session()->flash('message', 'Estado actualizado.');
    }

    public function render()
    {
        return view('livewire.admin-citas', [
            'citas' => $this->citas,
            'resumen' => $this->resumen,
            'estados' => self::ESTADOS,
        ]);
    }
}
