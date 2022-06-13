<?php

class WebSocket
{
    private $socket;
    private $address;
    private $port;

    private $clients = array();

    private $globalDataJson = "";


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

        $dataFile = new DataFile();
        $this->globalDataJson = $dataFile->getData();

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

            foreach ($this->clients as $cl) {
                socket_write($cl, $this->globalDataJson);
            }
        }
    }
}
