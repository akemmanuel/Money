<?php

namespace App\Livewire;

use App\Models\Fiat;
use App\Models\Notification;
use App\Models\Price;
use Livewire\Component;

use Gemini\Data\GenerationConfig;
use Gemini\Data\Schema;
use Gemini\Enums\DataType;
use Gemini\Enums\ResponseMimeType;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Auth;

class Analysis extends Component
{
    public $notifications;
    public $depots = [];
    public $analysisResult;
    public $portfolio = '';

    public function mount()
    {
        $this->notifications = Notification::all();
        $this->depots = Auth::user()->depots;
        $depot_string = '';
        foreach ($this->depots as $depot) {
            $depot_string .= $depot->name . ' ';
            foreach ($depot->assets as $asset) {
                $depot_string .= $asset->currency . ': ' . $asset->balance . ' ' . $asset->type_of_currency . ' ' . $this->convert($asset->balance, $asset->currency, $asset->type_of_currency) . ', ';
            }
        };
        $this->portfolio = $depot_string;
    }

    public function render()
    {
        return view('livewire.analysis');
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
    public function analyze()
    {
        $result = Gemini::generativeModel(model: 'gemini-2.5-pro')
            ->withGenerationConfig(
                generationConfig: new GenerationConfig(
                    temperature: 0.5,
                    responseMimeType: ResponseMimeType::APPLICATION_JSON,
                    responseSchema: new Schema(
                            type: DataType::OBJECT,
                            properties: [
                                'summary' => new Schema(type: DataType::STRING),
                                'recommendations' => new Schema(type: DataType::ARRAY, items: new Schema(type: DataType::STRING)),
                                'quality' => new Schema(type: DataType::STRING, enum: ['weak', 'ok', 'good', 'strong', 'excellent']),
                            ],
                            required: ['summary', 'recommendations', 'quality'],
                    )
                )
            )
            ->generateContent('Analyze the following portfolio and provide a summary and steps to optimize it: ' . json_encode($this->portfolio));

        $this->analysisResult = $result->json();
    }
    // public function placeholder(array $params = [])
    // {
    //     return view('placeholder.skeleton', $params);
    // }
}



