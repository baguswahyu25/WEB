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
    public function user()
{
    return $this->belongsTo(User::class);
}

}

