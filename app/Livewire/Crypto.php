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
    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <div class="flex w-52 flex-col gap-4">
                <div class="skeleton skeleton-animated h-32 w-full"></div>
                <div class="skeleton skeleton-animated h-4 w-28"></div>
                <div class="skeleton skeleton-animated h-4 w-full"></div>
                <div class="skeleton skeleton-animated h-4 w-full"></div>
            </div>
        </div>
        HTML;
    }
    public function render()
    {
        return view('livewire.crypto');
    }
}
