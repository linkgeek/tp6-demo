<?php
declare (strict_types=1);

namespace app\listener;

class WsConnect
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        //实例化 Websocket 类
        $ws = app('\think\swoole\Websocket');

        //获取 fd
        //$fd = $ws->getSender();

        //获取当前发送消息客户端的 fd
        var_dump(123);
        var_dump($event);

        //获取 uid  var ws = new WebSocket("ws://127.0.0.1:9501/?uid=1");
        // $uid = $event->get('uid');

        //获取到 uid 和 fd 后，可以存数据库，内存或者 redis
        $ws->emit('sendfd', [
            'uid' => 0,
            'fd' => 0
        ]);
    }
}
