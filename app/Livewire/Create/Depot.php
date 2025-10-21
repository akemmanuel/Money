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
        ], [
            'name.required' => 'The depot name is required. Please enter a name for your depot.',
            'name.string' => 'The depot name must be text. Please enter a valid name.',
            'name.max' => 'The depot name cannot exceed 100 characters. Please shorten the name.',
            'description.string' => 'The description must be text. Please enter a valid description.',
            'description.max' => 'The description cannot exceed 255 characters. Please shorten the description.',
        ]);

        Auth::user()->depots()->create($validated);
        session()->flash('message', 'Depot created.');

        $this->reset(['name', 'description']);
    }
}