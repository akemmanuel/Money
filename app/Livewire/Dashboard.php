<?php

namespace App\Livewire;

use App\Models\Fiat;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    public $depots = [];

    public function mount()
    {
        $this->depots = Auth::user()->depots()->with('assets')->get();
    }
    public function render()
    {
        return view('livewire.dashboard');
    }

    public function getTotalValue()
    {
        return $this->depots->sum(function ($depot) {
            return $depot->assets->sum(function ($account) {
            return $this->convert($account->balance, $account->currency, $account->type_of_currency);
            });
        });
    }

    public function getChange($asset)
    {
        $prices = Price::where('currency', $asset->currency)
            ->where('type', $asset->type_of_currency)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        if ($prices->count() < 1 || !is_numeric($prices[0]->price_usd)) {
            return ['status' => 'no_data'];
        }

        if ($prices->count() < 2 || !is_numeric($prices[1]->price_usd)) {
            return ['status' => 'new'];
        }

        $latestPriceUsd = $prices[0]->price_usd;
        $previousPriceUsd = $prices[1]->price_usd;

        if ($latestPriceUsd == $previousPriceUsd) {
            return [
                'value' => 0,
                'percentage' => 0,
                'status' => 'no_change',
            ];
        }

        $fiat = new Fiat();
        $userCurrency = Auth::user()->display_currency;

        $conversionRate = 1;
        if ($userCurrency !== 'USD') {
            $conversionRate = $fiat->usdTo($userCurrency);
        }

        $currentValue = $latestPriceUsd * $asset->balance * $conversionRate;
        $previousValue = $previousPriceUsd * $asset->balance * $conversionRate;

        $changeValue = $currentValue - $previousValue;
        $percentageChange = ($previousValue != 0) ? ($changeValue / $previousValue) * 100 : 0;

        return [
            'value' => $changeValue,
            'percentage' => $percentageChange,
            'status' => 'ok',
        ];
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
}
