<?php

namespace App\Http\Livewire;

use App\Models\LinkEvent;
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

    //After plaid link is finised, this function is called
    //decided to have the logic here, so we can do anotehr api call to save the token information and exhange the tokken
    public function onSuccess($public_token, $metadata)
    {
        //create a log event
        $this->user->linkEvents()->create([
            'type' => 'success',
            'link_session_id' => $metadata['link_session_id'],
        ]);
    }

    //OnExit we want to capture it
    public function onExit($err, $metadata)
    {
        if ($err != null) {
            $this->user->linkEvents()->create([
                'type' => 'error',
                'link_session_id' => $metadata['link_session_id'],
                'error_type' => $err['error_type'],
                'error_code' => $err['error_code']
            ]);
        }
    }

    public function render()
    {
        return view('livewire.link');
    }
}
