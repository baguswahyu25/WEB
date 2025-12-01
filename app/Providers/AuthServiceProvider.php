<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Model => Policy
    ];

    public function boot(): void
    {
        // CUSTOM EMAIL VERIFICATION URL (untuk API)
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verifikasi Email Akun Anda')
                ->line('Klik tombol di bawah ini untuk memverifikasi email Anda.')
                ->action('Verifikasi Email', $url)
                ->line('Jika Anda tidak merasa membuat akun ini, abaikan saja email ini.');
        });
    }
}
