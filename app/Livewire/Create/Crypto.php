<?php

namespace App\Livewire\Create;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Crypto extends Component
{

    public $name;
    public $balance;
    public $currency;

    public function render()
    {
        return view('livewire.create.crypto');
    }

    public function create()
    {
         // Validierung der Eingabedaten
         $validated = $this->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'currency' => 'required|min:2'
        ]);

        // Konto für den authentifizierten Benutzer erstellen
        Auth::user()->cryptoAccounts()->create($validated);

        // Erfolgsmeldung
        session()->flash('message', 'Crypto Account erfolgreich erstellt.');

        // Eingabefelder zurücksetzen
        $this->reset(['name', 'balance', 'currency']);
    }
}

