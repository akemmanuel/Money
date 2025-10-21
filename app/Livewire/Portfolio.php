<?php

namespace App\Livewire;

use App\Models\CryptoPrices;
use App\Models\Fiat;
use App\Models\PortfolioHistory;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Portfolio extends Component
{
    public $depots = [];
    public $totalValue;
    public $previousDayValue;
    public $dailyChange;
    public $dailyPercentageChange;
    public $weeklyChange;
    public $weeklyPercentageChange;
    public $monthlyChange;
    public $monthlyPercentageChange;
    public $portfolioChart;

    public function mount()
    {
        $this->depots = Auth::user()->depots;
        $this->totalValue = $this->getTotalValue();

        $user = Auth::user();
        $today = Carbon::today();

        // Daily Change
        $yesterday = Carbon::yesterday();
        $previousDayPortfolio = PortfolioHistory::where('user_id', $user->id)
            ->whereDate('date', $yesterday)
            ->first();

        $this->previousDayValue = $previousDayPortfolio ? $previousDayPortfolio->value : 0;
        $this->dailyChange = $this->totalValue - $this->previousDayValue;
        $this->dailyPercentageChange = $this->previousDayValue != 0 ? ($this->dailyChange / $this->previousDayValue) * 100 : 0;

        // Weekly Change
        $sevenDaysAgo = Carbon::today()->subDays(7);
        $sevenDaysAgoPortfolio = PortfolioHistory::where('user_id', $user->id)
            ->whereDate('date', $sevenDaysAgo)
            ->first();
        $sevenDaysAgoValue = $sevenDaysAgoPortfolio ? $sevenDaysAgoPortfolio->value : 0;
        $this->weeklyChange = $this->totalValue - $sevenDaysAgoValue;
        $this->weeklyPercentageChange = $sevenDaysAgoValue != 0 ? ($this->weeklyChange / $sevenDaysAgoValue) * 100 : 0;

        // Monthly Change
        $thirtyDaysAgo = Carbon::today()->subDays(30);
        $thirtyDaysAgoPortfolio = PortfolioHistory::where('user_id', $user->id)
            ->whereDate('date', $thirtyDaysAgo)
            ->first();
        $thirtyDaysAgoValue = $thirtyDaysAgoPortfolio ? $thirtyDaysAgoPortfolio->value : 0;
        $this->monthlyChange = $this->totalValue - $thirtyDaysAgoValue;
        $this->monthlyPercentageChange = $thirtyDaysAgoValue != 0 ? ($this->monthlyChange / $thirtyDaysAgoValue) * 100 : 0;

        $this->portfolioChart = $this->generatePortfolioChart();
    }

    public function render()
    {
        return view('livewire.portfolio', [
            'totalValue' => $this->totalValue,
            'dailyChange' => $this->dailyChange,
            'dailyPercentageChange' => $this->dailyPercentageChange,
            'weeklyChange' => $this->weeklyChange,
            'weeklyPercentageChange' => $this->weeklyPercentageChange,
            'monthlyChange' => $this->monthlyChange,
            'monthlyPercentageChange' => $this->monthlyPercentageChange,
            'portfolioChart' => $this->portfolioChart,
        ]);
    }

    private function generatePortfolioChart()
    {
        $user = Auth::user();
        $history = PortfolioHistory::where('user_id', $user->id)
            ->orderBy('date', 'asc')
            ->get();

        $dates = $history->map(fn($item) => $item->date->format('Y-m-d'))->toArray();
        $values = $history->map(fn($item) => $item->value)->toArray();

        return (new LarapexChart())->lineChart()
            ->setTitle('Portfolio Value Over Time')
            ->setSubtitle('Historical performance')
            ->setColors(['#008FFB', '#ff6384'])
            ->setHeight(300)
            ->setXAxis($dates)
            ->setDataset([[
                'name' => 'Value',
                'data' => $values
            ]]);
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