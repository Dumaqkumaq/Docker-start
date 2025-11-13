<?php

namespace App;

use Predis\Client;

class RedisExample
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6379,
        ]);
    }

    public function setValue($key, $value)
    {
        return $this->client->set($key, $value);
    }

    public function getValue($key)
    {
        return $this->client->get($key);
    }
}
?>