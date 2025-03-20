<?php

namespace App\Livewire;

use App\Models\BitcoinAccount;
use App\Models\CryptoPrices;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Bitcoin extends Component
{
    public $bitcoin_accounts = [];
    public $bitcoin_usd;
    public $bitcoin_eur;
    public function mount()
    {
        $cryptoPrices = new CryptoPrices();

        $this->bitcoin_usd = $cryptoPrices->getPriceUsd("BTC");
        $this->bitcoin_eur = $cryptoPrices->getPriceEur("BTC");

        $this->bitcoin_accounts = Auth::user()->bitcoinAccounts;
    }
    public function render()
    {
        return view('livewire.bitcoin');
    }
}
