<?php
declare (strict_types=1);

namespace app\subscribe;

use app\Request;
use Swoole\Server;
use think\cache\driver\Redis;
use think\swoole\Websocket;

class WebSocketEvent
{
    protected $websocket = null;    //websocket对象
    protected $server = null;   //server对象
    protected $redis = null;    //redis对象

    public function __construct(Server $server, Websocket $websocket)
    {
        var_dump('__construct');
        $this->websocket = $websocket; //依赖注入的方式
        $this->server = $server;
        $this->redis = new Redis;
    }

    //onOpen触发的事件,传入的是一个request对象
    public function onConnect(Request $request)
    {
        //通过websocket的上下文取得fd:$this->websocket->getSender()
        $fd = $this->websocket->getSender();
        var_dump('onConnect', $fd);
        $this->server->push($fd, 'hello swoole');

        //把用户存到redis
        $this->redis->zadd('member', 0, $fd);

        //广播用户上线
        $members = $this->redis->zrange('member', 0, -1);
        foreach ($members as $member) {
            $this->server->push((int)$member, "{$fd}上线");
        }
    }

    public function onOpen()
    {
        $fd = $this->websocket->getSender();
        var_dump('onOpen', $fd);
    }

    public function onMessage()
    {
        $fd = $this->websocket->getSender();
        var_dump('onMessage', $fd);
        $this->server->push($fd, 'hello111 swoole');
    }

    //onClose触发的事件
    public function onClose()
    {
        //将离线的用户从关系表中移除
        $fd = $this->websocket->getSender();
        $res = $this->redis->zrem('member', $fd);
        var_dump($fd, $res);
    }

}
