<?php

namespace App\Http\Livewire\Users;

use App\Events\TransactionsUpdated;
use App\Models\User;
use Livewire\Component;

class AddUser extends Component
{
    public User $user;

    protected $rules = [
        'user.username' => 'required|unique:users,username'
    ];

    public function mount()
    {
        $this->user = new User;
    }

    public function save()
    {
        $this->validate();
        $this->user->save();
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.users.add-user');
    }
}
