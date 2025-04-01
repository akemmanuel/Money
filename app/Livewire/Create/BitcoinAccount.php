<?php

namespace App\Livewire\Create;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Price;
use Illuminate\Support\Facades\Log;

class BitcoinAccount extends Component
{
    public $name;
    public $description;
    public $currency;
    public $type_of_currency;
    public $balance;

    public function render()
    {
        return view('livewire.create.bitcoin-account');
    }

    public function create() {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'description'=> 'nullable|string|max:255',
            'balance' => 'required',
            'currency'=> 'required|string|max:100',
            'type_of_currency'=> 'required',
        ]);
        Log::info('Creating a new account for user: ' . Auth::id(), $validated);

        Auth::user()->accounts()->create($validated);
        Log::info('Account created successfully for user: ' . Auth::id());

        Auth::user()->accounts()->latest()->first()->transactions()->create([
            'amount' => $this->balance,
            'type' => 'increase',
            'title' => 'Initial deposit',
            'description' => 'Initial balance deposit for account ' . $this->name,
        ]);
        Log::info('Initial transaction created for account: ' . $this->name);

        $priceModel = new Price();
        $priceUsd = $priceModel->getPriceUsd($this->currency, $this->type_of_currency);
        Log::info('Price in USD fetched for currency: ' . $this->currency . ', type: ' . $this->type_of_currency . ', price: ' . $priceUsd);

        dd($priceUsd);
        session()->flash('message', 'Bitcoin account created. Current price in USD: ' . $priceUsd);

        $this->reset(['name', 'description', 'balance', 'currency']);
    }
}
