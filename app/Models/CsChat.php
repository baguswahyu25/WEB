<?php
namespace App\Models;
class CsChat extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'reply',
        'status'
    ];
}

