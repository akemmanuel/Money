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
        $this->depots = Auth::user()->depots()->with('assets')->get();
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
                            'diversification' => new Schema(type: DataType::NUMBER),
                            'risk' => new Schema(type: DataType::STRING, enum: ['low', 'medium', 'high']),
                            'quality' => new Schema(type: DataType::STRING, enum: ['F', 'D', 'C', 'B', 'A']),
                        ],
                        required: ['summary', 'recommendations', 'diversification', 'risk', 'quality'],
                    )
                )
            )
            ->generateContent('Analyze the following portfolio and provide a summary and steps to optimize it: ' . json_encode($this->portfolio));

        $this->analysisResult = $result->json();
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



