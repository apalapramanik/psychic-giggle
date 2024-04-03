<?php
require_once __DIR__ . '/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;

class Game implements MessageComponentInterface {
    private $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // add new client connection
        $this->clients->attach($conn);
        echo "New client connected: {$conn->resourceId}\n";
    }

    public function onClose(ConnectionInterface $conn) {
        // remove closed client connection
        $this->clients->detach($conn);
        echo "Client disconnected: {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $resourceId = $from->resourceId;
        // broadcast message to all clients except sender
        foreach ($this->clients as $client) {
            $client->send("{$msg}: {$resourceId}");
        }
    }
}

$gameSocket = new WsServer(new Game());
$httpServer = new HttpServer($gameSocket);

$server = IoServer::factory($httpServer, 8080);
$server->run();

?>
