<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkEvent extends Model
{
    use HasFactory;

    protected $table = 'link_events';

    protected $fillable = [
        'type',
        'user_id',
        'link_session_id',
        'error_type',
        'error_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
