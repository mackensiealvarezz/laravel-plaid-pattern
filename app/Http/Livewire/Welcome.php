<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Welcome extends Component
{

    protected $listeners = [
        'echo:transactions,TransactionsUpdated' =>  'transactionsUpdated',
        'refresh' => '$refresh'
    ];

    public function transactionsUpdated()
    {
        $this->alert('success', 'Transactions have been updated', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        //This will tell the table to refresh because we have a new item
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.welcome', [
            'user_count' => User::count()
        ]);
    }
}
