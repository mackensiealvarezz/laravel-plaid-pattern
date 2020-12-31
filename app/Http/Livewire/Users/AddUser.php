<?php

namespace App\Http\Livewire\Users;

use App\Events\TransactionsUpdated;
use App\Models\User;
use Livewire\Component;

class AddUser extends Component
{
    public User $user;

    //This will listen for refresh when a user is added and create a new object
    protected $listeners = ['refresh' => '$refresh'];

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
        //refresh the counter and table
        $this->emit('refresh');
        //tell alpine to close the dropdown
        $this->dispatchBrowserEvent('added-user');
    }

    public function render()
    {
        return view('livewire.users.add-user');
    }
}
