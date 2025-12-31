<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\VerifyEmailCustom;
use Illuminate\Support\Facades\Storage;




class User extends Authenticatable implements MustVerifyEmail

{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
protected $appends = ['avatar_url_full'];

public function getAvatarUrlFullAttribute()
{
    return $this->avatar_url
        ? Storage::url($this->avatar_url)
        : null;
}
protected static function booted()
{
    static::deleting(function ($user) {
        if ($user->profile_photo_path &&
            Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }
    });
}

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'notif_cs' => 'boolean',
        'notif_promo' => 'boolean',
        'notif_update' => 'boolean',
    ];
}
public function sendEmailVerificationNotification()
{
    $this->notify(new VerifyEmailCustom);
}
}
