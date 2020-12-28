<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Plaid\Plaid;
use Livewire\Component;

class UserTable extends Component
{
    protected $listeners = [
        'refresh'  => '$refresh'
    ];

    public function render()
    {
        return view('livewire.users.user-table', [
            'users' => User::all()
        ]);
    }
}
