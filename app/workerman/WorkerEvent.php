<?php


namespace app\workerman;

use think\worker\Server;

class WorkerEvent extends Server
{
    protected $socket = 'http://0.0.0.0:4077';

    public function onConnect($connection)
    {
        var_dump('connect success');
    }

    public function onMessage($connection, $data)
    {
        var_dump($data);
        $connection->send(json_encode($data));
    }

    public function onClose($connection)
    {
        var_dump('close success');
    }
}