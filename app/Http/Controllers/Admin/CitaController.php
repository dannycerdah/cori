<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('paciente', 'especialidad')->orderBy('fecha')->orderBy('hora')->get();
        return view('admin.citas.index', compact('citas'));
    }

    public function pacientes()
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        return view('admin.pacientes.index', compact('pacientes'));
    }

    public function changeStatus(Request $request, Cita $cita)
    {
        $data = $request->validate([
            'estado' => 'required|in:pendiente,atendido,cancelado',
        ]);

        $cita->update($data);

        return back()->with('status', 'Estado de la cita actualizado.');
    }
}
