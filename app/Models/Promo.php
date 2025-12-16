<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Promo extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image_url',
        'expired_at',
        'is_active'
    ];
}
