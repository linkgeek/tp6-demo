<?php
// 事件定义文件
return [
    'bind'      => [
    ],

    'listen'    => [
        'AppInit'  => [],
        'HttpRun'  => [],
        'HttpEnd'  => [],
        'LogLevel' => [],
        'LogWrite' => [],


        //监听连接，swoole 事件必须以 swoole 开头
//        'swoole.websocket.Connect' => [
//            app\listener\WsConnect::class
//        ],
//        //监听关闭
//        'swoole.websocket.Close' => [
//            app\listener\WsClose::class
//        ],
//        //监听 Test 场景
//        'swoole.websocket.Test' => [
//            app\listener\WsTest::class
//        ],
//        //加入房间事件
//        'swoole.websocket.Join' => [
//            app\listener\WsJoin::class
//        ],
//        //离开房间事件
//        'swoole.websocket.Leave' => [
//            app\listener\WsLeave::class
//        ],
//        //处理聊天室消息
//        'swoole.websocket.RoomTest' => [
//            app\listener\RoomTest::class
//        ],

        'swoole.task' => [
            app\listener\SwooleTask::class,
        ],
        'swoole.finish' => [
            app\listener\SwooleFinishTask::class,
        ],
    ],

    'subscribe' => [
    ],
];
