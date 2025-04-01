<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditAccount extends Component
{
    public $account;

    public function mount($id)
    {
        $this->account = Auth::user()->accounts()->find($id);
    }
    public function render()
    {
        return view('livewire.edit-account');
    }
}
