<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class Analysis extends Component
{
    public $notifications;

    public function mount()
    {
        $this->notifications = Notification::all();
    }
    
    public function render()
    {
        return view('livewire.analysis');
    }

    // public function placeholder(array $params = [])
    // {
    //     return view('placeholder.skeleton', $params);
    // }
}
