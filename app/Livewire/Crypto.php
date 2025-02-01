<?php

namespace App\Livewire;

use App\Models\CryptoPrices;
use Livewire\Component;

class Crypto extends Component
{
    public $bitcoin_usd = 0;

    public function mount()
    {
        $cryptoPrices = new CryptoPrices();
        $this->bitcoin_usd = $cryptoPrices->getPriceUsd("BTC");
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
