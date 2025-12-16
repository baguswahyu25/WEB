<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseNotificationService
{
    protected $messaging;

    public function __construct()
    {
        $this->messaging = (new Factory)
            ->withServiceAccount(storage_path('firebase.json'))
            ->createMessaging();
    }

    /**
     * Kirim notifikasi ke 1 device
     */
    public function sendToToken(string $token, string $title, string $body): void
    {
        $message = CloudMessage::fromArray([
            'token' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
        ]);

        $this->messaging->send($message);
    }
}
