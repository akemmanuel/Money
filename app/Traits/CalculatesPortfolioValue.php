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

    public function calculateTotalValue()
    {
        $user = Auth::user();
        $displayCurrency = $user->display_currency;
        return $user->depots->sum(function ($depot) use ($user, $displayCurrency) {
            return $depot->assets->sum(function ($account) use ($user, $displayCurrency) {
                $value = $this->convert($account->balance, $account->currency, $account->type_of_currency, $displayCurrency);
                return $value;
            });
        });
    }

    public function calculateDailyChange()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $currentValue = $this->calculateTotalValue();
        $previousDayValue = $user->portfolioHistories()->whereDate('date', $yesterday)->value('value') ?? 0;

        return $currentValue - $previousDayValue;
    }

    public function calculateDailyPercentageChange()
    {
        $user = Auth::user();
        $yesterday = Carbon::yesterday();

        $currentValue = $this->calculateTotalValue();
        $previousDayValue = $user->portfolioHistories()->whereDate('date', $yesterday)->value('value') ?? 0;

        if ($previousDayValue == 0) {
            return 0;
        }

        return (($currentValue - $previousDayValue) / $previousDayValue) * 100;
    }

    public function calculateWeeklyChange()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $oneWeekAgo = Carbon::today()->subWeek();

        $currentValue = $this->calculateTotalValue();
        $previousWeekValue = $user->portfolioHistories()->whereDate('date', $oneWeekAgo)->value('value') ?? 0;

        return $currentValue - $previousWeekValue;
    }

    public function calculateWeeklyPercentageChange()
    {
        $user = Auth::user();
        $oneWeekAgo = Carbon::today()->subWeek();

        $currentValue = $this->calculateTotalValue();
        $previousWeekValue = $user->portfolioHistories()->whereDate('date', $oneWeekAgo)->value('value') ?? 0;

        if ($previousWeekValue == 0) {
            return 0;
        }

        return (($currentValue - $previousWeekValue) / $previousWeekValue) * 100;
    }

    public function calculateMonthlyChange()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $oneMonthAgo = Carbon::today()->subMonth();

        $currentValue = $this->calculateTotalValue();
        $previousMonthValue = $user->portfolioHistories()->whereDate('date', $oneMonthAgo)->value('value') ?? 0;

        return $currentValue - $previousMonthValue;
    }

    public function calculateMonthlyPercentageChange()
    {
        $user = Auth::user();
        $oneMonthAgo = Carbon::today()->subMonth();

        $currentValue = $this->calculateTotalValue();
        $previousMonthValue = $user->portfolioHistories()->whereDate('date', $oneMonthAgo)->value('value') ?? 0;

        if ($previousMonthValue == 0) {
            return 0;
        }

        return (($currentValue - $previousMonthValue) / $previousMonthValue) * 100;
    }
}
