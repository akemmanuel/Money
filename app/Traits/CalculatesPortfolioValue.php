<?php

namespace App\Traits;

use App\Models\Fiat;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

trait CalculatesPortfolioValue
{
    public function convert($balance, $currency, $type, $displayCurrency)
    {
        if ($displayCurrency == $currency) {
            return $balance;
        }
        $price = new Price();
        $priceUsd = $price->getPriceUsd($currency, $type) * $balance;

        // Cache the usdTo conversion rate for 5 minutes
        $cacheKey = 'usd_to_' . $displayCurrency;
        $fiat = new Fiat();
        $usdToRate = Cache::remember($cacheKey, 300, function () use ($fiat, $displayCurrency) {
            return $fiat->usdTo($displayCurrency);
        });

        $end = $usdToRate * $priceUsd;

        return $end;
    }

    public function getTotalValue($user)
    {
        $displayCurrency = $user->display_currency;
        return $user->depots->sum(function ($depot) use ($user, $displayCurrency) {
            return $depot->assets->sum(function ($account) use ($user, $displayCurrency) {
                $value = $this->convert($account->balance, $account->currency, $account->type_of_currency, $displayCurrency);
                return $value;
            });
        });
    }
}
