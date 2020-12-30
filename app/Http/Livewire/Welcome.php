<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Welcome extends Component
{

    protected $listeners = ['echo:transactions,TransactionsUpdated' =>  'transactionsUpdated'];

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
    }

    public function render()
    {
        return view('livewire.welcome');
    }
}
