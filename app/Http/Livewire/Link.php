<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Plaid\Plaid;
use Livewire\Component;

class Link extends Component
{
    public User $user;

    public function createLinkToken(User $user)
    {
        return (new Plaid)->createLinkToken($user)['link_token'];
    }

    public function render()
    {
        return view('livewire.link');
    }
}
