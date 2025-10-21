<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateBankAccount extends Component
{
    public $name;
    public $balance;

    public function render()
    {
        return view('livewire.create-bank-account');
    }

    public function create()
    {
         // Validierung der Eingabedaten
         $validated = $this->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric',
        ], [
            'name.required' => __('validation.custom.name.required'),
            'name.string' => __('validation.custom.name.string'),
            'name.max' => __('validation.custom.name.max'),
            'balance.required' => __('validation.custom.balance.required'),
            'balance.numeric' => __('validation.custom.balance.numeric'),
        ]);

        Auth::user()->bankAccounts()->create($validated);

        session()->flash('message', 'Bank account created successfully.');

        // Eingabefelder zurücksetzen
        $this->reset(['name', 'balance']);
    }
}
