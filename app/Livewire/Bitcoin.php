<?php

namespace App\Livewire;

use App\Models\CryptoPrices;
use App\Models\Fiat;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Bitcoin extends Component
{
    public $accounts = [];

    public function mount()
    {
        $this->accounts = Auth::user()->accounts;
    }

    public function render()
    {
        return view('livewire.bitcoin');
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
        return $this->accounts->sum(function($account) {
            return $this->convert($account->balance, $account->currency, $account->type_of_currency);
        });
    }
}
