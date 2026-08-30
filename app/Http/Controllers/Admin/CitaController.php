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
        return view('admin.citas.index');
    }

    public function pacientes()
    {
        $pacientes = Paciente::orderBy('apellidos')->orderBy('nombres')->paginate(20);

        return view('admin.pacientes.index', compact('pacientes'));
    }

    public function changeStatus(Request $request, Cita $cita)
    {
        $data = $request->validate([
            'estado' => 'required|in:REGISTRADA,CONFIRMADA,ATENDIDA,CANCELADA,NO_ASISTIO',
        ]);

        $cita->update($data);

        return back()->with('status', 'Estado de la cita actualizado.');
    }
}
