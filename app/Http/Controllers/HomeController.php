<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
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
                'nombre' => $paciente->nombre,
                'email' => $paciente->email,
                'telefono' => $paciente->telefono,
            ],
        ]);
    }

    public function storeCita(Request $request)
    {
        $data = $request->validate([
            'paciente_nombre' => 'required|string|max:255',
            'tipo_documento' => 'required|in:DNI,CE',
            'numero_documento' => 'required|string|min:8|max:10',
            'telefono' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'especialidad_id' => 'required|exists:especialidades,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'notas' => 'nullable|string|max:1000',
        ], [
            'paciente_nombre.required' => 'El nombre del paciente es obligatorio.',
            'tipo_documento.required' => 'Selecciona el tipo de documento.',
            'tipo_documento.in' => 'Tipo de documento inválido.',
            'numero_documento.required' => 'El número de documento es obligatorio.',
            'numero_documento.min' => 'El número de documento debe tener al menos 8 caracteres.',
            'numero_documento.max' => 'El número de documento no puede tener más de 10 caracteres.',
            'telefono.required' => 'El telefono es obligatorio.',
            'especialidad_id.required' => 'Selecciona una especialidad.',
            'especialidad_id.exists' => 'La especialidad seleccionada no es valida.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.after_or_equal' => 'La fecha no puede ser en el pasado.',
            'hora.required' => 'La hora es obligatoria.',
            'hora.date_format' => 'Formato de hora invalido.',
            'email.email' => 'Ingresa un correo electronico valido.',
        ]);

        DB::transaction(function () use ($data): void {
            $paciente = Paciente::firstOrNew([
                'tipo_documento' => $data['tipo_documento'],
                'numero_documento' => $data['numero_documento'],
            ]);

            $paciente->fill([
                'nombre' => (string) $data['paciente_nombre'],
                'telefono' => (string) $data['telefono'],
                'email' => $data['email'] ?? null,
            ]);

            $paciente->save();

            Cita::create([
                'paciente_id' => $paciente->id,
                'especialidad_id' => (int) $data['especialidad_id'],
                'fecha' => (string) $data['fecha'],
                'hora' => (string) $data['hora'],
                'estado' => 'pendiente',
                'notas' => $data['notas'] ?? null,
            ]);
        });

        return back()->with('message', '¡Cita registrada correctamente! Nos pondremos en contacto contigo pronto.');
    }
}
