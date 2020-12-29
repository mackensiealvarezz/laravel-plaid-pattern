<?php

namespace App\Plaid;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class Plaid
{

    public function baseUrl()
    {
        return 'https://' . config('services.plaid.env') . '.plaid.com';
    }

    //Create a link token
    public function createLinkToken(User $user)
    {
        return Http::post(self::baseUrl() . '/link/token/create', [
            'client_id' => config('services.plaid.clientId'),
            'secret' => config('services.plaid.secret'),
            'country_codes' => ['US'],
            'language' => 'en',
            'client_name' => 'Test Client',
            'user' => [
                'client_user_id' => "$user->id"
            ],
            'webhook' => 'https://e5163004ca7ec8b8764b0091dccaa513.m.pipedream.net',
            'products' => ['transactions']
        ])->json();
    }
}
