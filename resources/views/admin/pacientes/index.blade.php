@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-4">Panel administrativo - Pacientes</h1>
    <table class="min-w-full border-collapse">
        <thead>
            <tr>
                <th class="border p-2">ID</th>
                <th class="border p-2">Nombre</th>
                <th class="border p-2">Teléfono</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
            <tr>
                <td class="border p-2">{{ $paciente->id }}</td>
                <td class="border p-2">{{ $paciente->nombre }}</td>
                <td class="border p-2">{{ $paciente->telefono }}</td>
                <td class="border p-2">{{ $paciente->email ?? '-' }}</td>
                <td class="border p-2">{{ $paciente->fecha_nacimiento ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection