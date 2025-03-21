<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Settings extends Component
{
    public $currency;

    public function mount()
    {
        $this->currency = Auth::user()->display_currency;
    }

    public function updateCurrency()
    {
        $user = Auth::user();
        $user->display_currency = $this->currency;
        $user->save();
    }

    public function placeholder(array $params = [])
    {
        return view('placeholder.skeleton', $params);
    }

    public function render()
    {
        return view('livewire.settings');
    }
}
