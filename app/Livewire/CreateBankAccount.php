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
        ]);

        // Konto für den authentifizierten Benutzer erstellen
        Auth::user()->bankAccounts()->create($validated);

        // Erfolgsmeldung
        session()->flash('message', 'Bankkonto erfolgreich erstellt.');

        // Eingabefelder zurücksetzen
        $this->reset(['name', 'balance']);
    }
}
