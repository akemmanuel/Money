<?php

namespace App\Traits;

use App\Models\Fiat;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

trait CalculatesPortfolioValue
{
    public function convert($balance, $currency, $type)
    {
        $currency_user =  Auth::user()->display_currency;
        if ($currency_user == $currency) {
            return $balance;
        }
        $price = new Price();
        $priceUsd = $price->getPriceUsd($currency, $type) * $balance;

        // Cache the usdTo conversion rate for 5 minutes
        $cacheKey = 'usd_to_' . $currency_user;
        $fiat = new Fiat();
        $usdToRate = Cache::remember($cacheKey, 300, function () use ($fiat, $currency_user) {
            return $fiat->usdTo($currency_user);
        });

        $end = $usdToRate * $priceUsd;

        return $end;
    }

    public function getTotalValue($user)
    {
        return $user->depots->sum(function ($depot) use ($user) {
            return $depot->assets->sum(function ($account) use ($user) {
                // Temporarily set the authenticated user for the convert function
                Auth::login($user);
                $value = $this->convert($account->balance, $account->currency, $account->type_of_currency);
                Auth::logout();
                return $value;
            });
        });
    }
}
