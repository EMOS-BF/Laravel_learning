<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LocationComp extends Component
{
    public function render()
    {
        return view('livewire.locations.index')
        ->extends("layouts.master")
        ->section("contenu");
    }
}
