<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\WebSocket\NotificationServer;

class WebSocketServe extends Command
{
    protected $signature = 'websocket:serve';
    protected $description = 'Start WebSocket server for notifications';

    public function handle()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new NotificationServer()
                )
            ),
            8080
        );

        $this->info('WebSocket server started on port 8080');
        $server->run();
    }
}
