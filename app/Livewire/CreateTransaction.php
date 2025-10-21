<?php

namespace App\Livewire;

use App\Models\Asset;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateTransaction extends Component
{
    public $assets;
    public $asset_id;
    public $type = 'buy'; // Default to 'buy'
    public $title;
    public $description;
    public $amount;

    protected $rules = [
        'asset_id' => 'required|exists:assets,id',
        'type' => 'required|in:buy,sell',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'amount' => 'required|numeric|min:0.01',
    ];

    public function mount()
    {
        $this->assets = Auth::user()->depots->flatMap(fn ($depot) => $depot->assets);
    }

    public function store()
    {
        $this->validate();

        Transaction::create([
            'asset_id' => $this->asset_id,
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'amount' => $this->amount,
        ]);

        session()->flash('message', 'Transaction created successfully.');

        $this->reset(['asset_id', 'type', 'title', 'description', 'amount']);
    }

    public function render()
    {
        return view('livewire.create-transaction');
    }
}