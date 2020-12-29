<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = "items";

    protected $fillable = [
        'user_id',
        'plaid_access_token',
        'plaid_item_id',
        'plaid_institution_id',
        'status'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
