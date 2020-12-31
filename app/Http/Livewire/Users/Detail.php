<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Detail extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.users.detail', [
            'item_count' => $this->user->items->count()
        ]);
    }
}
