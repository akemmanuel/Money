<?php

namespace App\Livewire;

use App\Models\Asset;
use App\Models\Depot;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RealEstate extends Component
{
    public $name;
    public $value;
    public $currency = 'USD'; // Default currency
    public $description;

    protected $rules = [
        'name' => 'required|string|max:255',
        'value' => 'required|numeric|min:0',
        'currency' => 'required|string|max:3',
        'description' => 'nullable|string|max:255',
    ];

    public function saveRealEstate()
    {
        $this->validate();

        $user = Auth::user();

        // Find or create a default 'Real Estate' depot for the user
        $depot = Depot::firstOrCreate(
            ['user_id' => $user->id, 'name' => 'Real Estate'],
            ['description' => 'Depot for real estate investments']
        );

        Asset::create([
            'user_id' => $user->id,
            'depot_id' => $depot->id,
            'name' => $this->name,
            'balance' => $this->value,
            'currency' => $this->currency,
            'type_of_currency' => 'real_estate',
            'description' => $this->description,
        ]);

        session()->flash('message', 'Real Estate asset added successfully.');

        $this->reset(['name', 'value', 'currency', 'description']);
    }

    public function render()
    {
        return view('livewire.real-estate');
    }
}
