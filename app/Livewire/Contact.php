<?php

namespace App\Livewire;

use App\Models\ContentSection;
use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        $contact = ContentSection::whereIn('key', ['contact_address', 'contact_reference', 'contact_phone', 'contact_email'])
            ->where('active', true)
            ->get()
            ->keyBy('key');
        return view('livewire.contact', compact('contact'));
    }
}
