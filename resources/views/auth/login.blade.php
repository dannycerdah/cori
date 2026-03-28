@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Ingreso administrativo</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full border rounded p-2" required autofocus />
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" class="mt-1 block w-full border rounded p-2" required />
            @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded">Ingresar</button>
    </form>
</div>
@endsection