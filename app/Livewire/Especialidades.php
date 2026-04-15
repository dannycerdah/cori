<?php

namespace App\Livewire;

use App\Models\Especialidad;
use Illuminate\Support\Str;
use Livewire\Component;

class Especialidades extends Component
{
    public function render()
    {
        $cardioImage = file_exists(public_path('images/specialties/cardiologia.png'))
            ? asset('images/specialties/cardiologia.png')
            : asset('images/specialties/cardiologia.svg');

        $especialidades = Especialidad::all()->map(function (Especialidad $especialidad) use ($cardioImage) {
            $normalizedName = Str::of($especialidad->nombre)->ascii()->lower()->value();

            $especialidad->card_image = match (true) {
                str_contains($normalizedName, 'cardio') => $cardioImage,
                str_contains($normalizedName, 'pedia') => asset('images/specialties/pediatria.svg'),
                str_contains($normalizedName, 'derma') => asset('images/specialties/dermatologia.svg'),
                str_contains($normalizedName, 'odonto') => asset('images/specialties/odontologia.svg'),
                str_contains($normalizedName, 'neuro') => asset('images/specialties/neurologia.svg'),
                default => $cardioImage,
            };

            return $especialidad;
        });

        return view('livewire.especialidades', ['especialidades' => $especialidades]);
    }
}
