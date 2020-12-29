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
            'webhook' => '',
            'products' => ['transactions']
        ])->json();
    }

    public function exchangePublicToken($publicToken)
    {
        return Http::post(self::baseUrl() . '/item/public_token/exchange', [
            'client_id' => config('services.plaid.clientId'),
            'secret' => config('services.plaid.secret'),
            'public_token' => $publicToken,
        ])->json();
    }
}
