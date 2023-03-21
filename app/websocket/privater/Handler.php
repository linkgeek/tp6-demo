<?php

namespace app\websocket\privater;

use Swoole\Server;
use Swoole\Websocket\Frame;
use Swoole\WebSocket\Server as WebsocketServer;
use think\Config;
use think\Request;
use think\swoole\Websocket;
//use think\swoole\contract\websocket\HandlerInterface;

//用于websocket事件的响应,如open/message等.必要文件
//Handler全部返回false,将逻辑全部交给WebsocketEvent处理
class Handler extends Websocket
{
    /** @var WebsocketServer */
    protected $server;

    /** @var Config */
    protected $config;


    public function __construct(Server $server, Config $config)
    {
        $this->server = $server;
        $this->config = $config;
    }

    /**
     * "onOpen" listener.
     *
     * @param int $fd
     * @param Request $request
     */
    public function onOpen($fd, Request $request)
    {
        //交给Connect监听处理
        return false;
    }

    /**
     * "onMessage" listener.
     *  only triggered when event handler not found/返回false触发监听,返回true直接完成
     *
     * @param Frame $frame
     * @return bool
     */
    public function onMessage(Frame $frame)
    {
        //返回false触发全局监听
        return false;
    }

    /**
     * "onClose" listener.
     *
     * @param int $fd
     * @param int $reactorId
     */
    public function onClose($fd, $reactorId)
    {
        return false;
    }
}