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

    public function createLinkToken(User $user)
    {
        return (new Plaid)->createLinkToken($user)['link_token'];
    }

    public function render()
    {
        return view('livewire.users.user-table', [
            'users' => User::all()
        ]);
    }
}
