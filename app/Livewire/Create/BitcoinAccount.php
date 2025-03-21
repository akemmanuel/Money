<?php

namespace App\Livewire\Create;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BitcoinAccount extends Component
{
    public $name;
    public $description;
    public $currency;
    public $balance;

    public function render()
    {
        return view('livewire.create.bitcoin-account');
    }

    public function create() {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'description'=> 'nullable|string|max:255',
            'balance' => 'required|numeric',
            'currency'=> 'required|string|max:100',
        ]);

        Auth::user()->accounts()->create($validated);
        Auth::user()->bitcoinAccounts()->latest()->first()->transactions()->create([
            'amount' => $this->balance,
            'type' => 'increase',
            'usd' => $this->balance * $bitcoin_usd,
            'eur' => $this->balance * $bitcoin_eur,
        ]);

        // Erfolgsmeldung
        session()->flash('message', 'Bitcoin account created.');

        // Eingabefelder zurücksetzen
        $this->reset(['name', 'balance']);
    }
}
