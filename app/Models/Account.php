<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = "accounts";
    protected $fillable = [
        'item_id',
        'plaid_account_id',
        'name',
        'mask',
        'official_name',
        'current_balance',
        'available_balance',
        'iso_currency_code',
        'unofficial_currency_code',
        'type',
        'subtype',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
