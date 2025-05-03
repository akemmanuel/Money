<?php

namespace App\Livewire\Create;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Depot extends Component
{
    public $name;
    public $description;
    public $currency;
    public $type_of_currency;
    public $balance;

    public function render()
    {
        return view('livewire.create.depot');
    }

    public function create() {
        $validated = $this->validate([
            'name' => 'required|string|max:100',
            'description'=> 'nullable|string|max:255',
        ]);

        Auth::user()->depots()->create($validated);
        session()->flash('message', 'Depot created.');

        $this->reset(['name', 'description']);
    }
}