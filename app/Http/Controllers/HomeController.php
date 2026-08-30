<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function nosotros()
    {
        return view('nosotros');
    }

    public function contacto()
    {
        return view('contacto');
    }

    public function citas()
    {
        return view('citas');
    }

    public function buscarPaciente(Request $request)
    {
        $data = $request->validate([
            'tipo_documento' => 'required|in:DNI,CE',
            'numero_documento' => 'required|string|min:8|max:10',
        ]);

        $paciente = Paciente::where('tipo_documento', $data['tipo_documento'])
            ->where('numero_documento', $data['numero_documento'])
            ->first();

        if (! $paciente) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'paciente' => [
                'nombres' => $paciente->nombres,
                'apellidos' => $paciente->apellidos,
                'nombre' => $paciente->nombre_completo,
                'correo' => $paciente->correo,
                'telefono' => $paciente->telefono,
            ],
        ]);
    }
}
