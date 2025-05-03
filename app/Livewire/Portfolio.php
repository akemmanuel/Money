<?php

namespace App\Livewire;

use App\Models\CryptoPrices;
use App\Models\Fiat;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Portfolio extends Component
{
    public $depots = [];

    public function mount()
    {
        $this->depots = Auth::user()->depots;
    }

    public function render()
    {
        return view('livewire.portfolio');
    }

    public function convert($balance, $currency, $type)
    {
        $currency_user =  Auth::user()->display_currency;
        if ($currency_user == $currency) {
            return $balance;
        }
        $price = new Price();
        $priceUsd = $price->getPriceUsd($currency, $type) * $balance;
        $fiat = new Fiat();
        $end = $fiat->usdTo($currency_user) * $priceUsd;

        return $end;
    }

    public function getTotalValue()
    {
        return $this->depots->sum(function ($depot) {
            return $depot->assets->sum(function ($account) {
            return $this->convert($account->balance, $account->currency, $account->type_of_currency);
            });
        });
    }

    public function placeholder(array $params = [])
    {
        return view('placeholder.skeleton', $params);

    }
}
