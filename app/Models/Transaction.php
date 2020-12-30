<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";
    protected $fillable = [
        'account_id',
        'plaid_transaction_id',
        'plaid_category_id',
        'category',
        'subcategory',
        'type',
        'name',
        'amount',
        'iso_currency_code',
        'unofficial_currency_code',
        'date',
        'pending',
        'account_owner'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
