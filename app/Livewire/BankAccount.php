<?php

namespace App\Livewire;

use App\Models\BankAccount as ModelsBankAccount;
use Livewire\Component;

class BankAccount extends Component
{
    public $accounts;

    public function mount()
    {
        $this->accounts = ModelsBankAccount::all();
    }

    public function placeholder(array $params = [])
    {
        return view('placeholder.skeleton', $params);

    }
    public function render()
    {
        return view('livewire.bank-account');
    }
}
