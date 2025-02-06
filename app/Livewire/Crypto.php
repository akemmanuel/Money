<?php

namespace App\Livewire;

use App\Models\CryptoAccount;
use App\Models\CryptoPrices;
use Livewire\Component;

class Crypto extends Component
{
    public $bitcoin_usd = 0;
    public $bitcoin_eur = 0;
    public $cryptos;
    public $prices_usd = [];
    public $prices_eur = [];
    public function mount()
    {
        $cryptoPrices = new CryptoPrices();

        $this->bitcoin_usd = $cryptoPrices->getPriceUsd("BTC");
        $this->bitcoin_eur = $cryptoPrices->getPriceEur("BTC");
        $this->cryptos = CryptoAccount::all();
        foreach ($this->cryptos as $crypto) {
            $this->prices_usd[$crypto->currency] = $cryptoPrices->getPriceUsd($crypto->currency);
            $this->prices_eur[$crypto->currency] = $cryptoPrices->getPriceEur($crypto->currency);
        }
    }
    public function placeholder(array $params = [])
    {
        return view('placeholder.skeleton', $params);

    }
    public function render()
    {
        return view('livewire.crypto');
    }
}
