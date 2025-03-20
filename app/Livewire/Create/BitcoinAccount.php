<?php

namespace App\Livewire\Create;

use App\Models\CryptoPrices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BitcoinAccount extends Component
{
    public $name;
    public $balance;

    public function render()
    {
        return view('livewire.create.bitcoin-account');
    }

    public function create() {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric',
        ]);
        $cryptoPrices = new CryptoPrices();

        $bitcoin_usd = $cryptoPrices->getPriceUsd("BTC");
        $bitcoin_eur = $cryptoPrices->getPriceEur("BTC");
        // Konto für den authentifizierten Benutzer erstellen
        Auth::user()->bitcoinAccounts()->create($validated);
        // Transaktion erstellen, um den Anfangswert festzulegen
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
