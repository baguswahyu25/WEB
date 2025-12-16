<?php

namespace App\WebSocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Models\User;

class NotificationServer implements MessageComponentInterface
{
    protected $clients;
    protected $users; // userId => ConnectionInterface

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->users = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

        parse_str($conn->httpRequest->getUri()->getQuery(), $query);
        $token = $query['token'] ?? null;

        $user = User::where('api_token', $token)->first();
        if ($user) {
            $conn->userId = $user->id;
            $this->users[$user->id] = $conn;
        } else {
            $conn->close();
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {}
    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        if (isset($conn->userId)) unset($this->users[$conn->userId]);
    }
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }

    public function sendToUser(int $userId, array $data)
    {
        if (isset($this->users[$userId])) {
            $this->users[$userId]->send(json_encode($data));
        }
    }
}
