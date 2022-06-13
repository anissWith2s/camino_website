<?php

class WebSocket
{
    private $socket;
    private $address;
    private $port;

    private $clients = array();


    /**
     * @throws Exception
     */
    public function __construct($address = 'localhost', $port = 8080)
    {
        $this->address = $address;
        $this->port = $port;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            throw new Exception('socket_create() failed: ' . socket_strerror(socket_last_error()));
        }
        $this->socket = $socket;
        socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($socket, $address, $port);
        socket_listen($socket);

        $this->clients = array();
        $this->process();
    }

    /**
     * @throws Exception
     */
    public function process() {
        while (true) {
            $client = socket_accept($this->socket);
            if ($client === false) {
                throw new Exception('socket_accept() failed: ' . socket_strerror(socket_last_error()));
            }
            $this->clients[] = $client;
        }
    }
}
/*
$request = socket_read($client, 5000);
preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $request, $matches);
$key = base64_encode(pack(
    'H*',
    sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
));
$headers = "HTTP/1.1 101 Switching Protocols\r\n";
$headers .= "Upgrade: websocket\r\n";
$headers .= "Connection: Upgrade\r\n";
$headers .= "Sec-WebSocket-Version: 13\r\n";
$headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
socket_write($client, $headers, strlen($headers));

while (true) {
    sleep(1);
    $content = 'Now: ' . time();
    $response = chr(129) . chr(strlen($content)) . $content;
    socket_write($client, $response);
}*/
