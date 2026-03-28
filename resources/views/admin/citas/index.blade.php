@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-primary-blue mb-2">Panel Administrativo - Citas</h1>
        <p class="text-text-dark">Gestione las citas médicas registradas.</p>
    </div>
    @livewire('admin-citas')
</div>
@endsection