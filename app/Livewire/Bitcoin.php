<?php

namespace App\Livewire;

use App\Models\CryptoPrices;
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
}
