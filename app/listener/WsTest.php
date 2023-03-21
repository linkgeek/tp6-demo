<?php
declare (strict_types=1);

namespace app\listener;

use \think\swoole\Websocket;

class WsTest
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event, Websocket $ws)
    {
        // $ws = app('think\swoole\Websocket'); // 单例

        //获取当前发送消息客户端的 fd
        // var_dump($ws->getSender());

        //回复客户端消息
        $ws->emit("testcallback", ['aaaaa' => 1, 'getdata' => $event['asd']]);

        //发送给指定 fd 的客户端，包括发送者自己
        //$ws->to(intval($event['to']))->emit('testcallback', $event['message']);

        //发送广播消息
        //$ws->broadcast()->emit('testcallback', $event['message']);
    }
}