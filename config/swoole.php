<?php

use think\swoole\Table;
use think\swoole\websocket\socketio\Handler;

return [
    'server'     => [
        'host'      => env('SWOOLE_HOST', '0.0.0.0'), // 监听地址
        'port'      => env('SWOOLE_PORT', 4077), // 监听端口
        'mode'      => SWOOLE_PROCESS, // 运行模式 默认为SWOOLE_PROCESS
        'sock_type' => SWOOLE_SOCK_TCP, // sock type 默认为SWOOLE_SOCK_TCP
        'options'   => [
            'pid_file'              => runtime_path() . 'swoole.pid',
            'log_file'              => runtime_path() . 'swoole.log',
            'daemonize'             => false,
            // Normally this value should be 1~4 times larger according to your cpu cores.
            'reactor_num'           => swoole_cpu_num(),
            'worker_num'            => swoole_cpu_num(),
            'task_worker_num'       => swoole_cpu_num(),
            'enable_static_handler' => true,
            'document_root'         => root_path('public'),
            'package_max_length'    => 20 * 1024 * 1024,
            'buffer_output_size'    => 10 * 1024 * 1024,
            'socket_buffer_size'    => 128 * 1024 * 1024,
        ],
    ],
    'websocket'  => [
        'enable'        => true,
        //'handler'       => Handler::class,
        'handler'       => app\websocket\privater\Handler::class, //自定义websocket绑定类
        'parser'        => app\websocket\privater\Parser::class, //自定义解析类
        'ping_interval' => 25000,
        'ping_timeout'  => 60000,
        'room'          => [
            'type'  => 'table',
            'table' => [
                'room_rows'   => 4096,
                'room_size'   => 2048,
                'client_rows' => 8192,
                'client_size' => 2048,
            ],
            'redis' => [
                'host'          => '127.0.0.1',
                'port'          => 6379,
                'max_active'    => 3,
                'max_wait_time' => 5,
            ],
        ],
        'listen'        => [
//            'connect' => 'app\listener\WsConnect',
//            'close'   => 'app\listener\WsClose',
//            'test'    => 'app\listener\WsTest'
        ],
        'subscribe'     => [
            //app\subscribe\WebSocketEvent::class
        ],
    ],
    'rpc'        => [
        'server' => [
            'enable'   => false,
            'port'     => 9000,
            'services' => [
            ],
        ],
        'client' => [
        ],
    ],
    'hot_update' => [
        'enable'  => env('APP_DEBUG', false),
        'name'    => ['*.php'],
        'include' => [app_path()],
        'exclude' => [],
    ],
    //连接池
    'pool'       => [
        'db'    => [
            'enable'        => true,
            'max_active'    => 3,
            'max_wait_time' => 5,
        ],
        'cache' => [
            'enable'        => true,
            'max_active'    => 3,
            'max_wait_time' => 5,
        ],
        //自定义连接池
    ],
    //队列
    'queue'      => [
        'enable'  => false,
        'workers' => [],
    ],
    'coroutine'  => [
        'enable' => true,
        'flags'  => SWOOLE_HOOK_ALL,
    ],
    // 高性能内存数据库
    // 应用场景
    // 1.socket 通信记录fd和用户的绑定关系
    // 2.当作缓存来全局读取记录数据
    // 3.能够当作计数器应用，原子级别。不会存在并发的问题框架中如何应用
    'tables'     => [
        'user' => [
            'size' => 20480, //指定数据库内存大小
            'columns' => [ //数据库字段
                ['name' => 'fd', 'type' => Table::TYPE_INT],//内置字段，自行设置
                ['name' => 'type', 'type' => Table::TYPE_INT],
                ['name' => 'uid', 'type' => Table::TYPE_INT, 'size'=> 1024],
                ['name' => 'to_uid', 'type' => Table::TYPE_INT],
                ['name' => 'tourist', 'type' => Table::TYPE_INT]
            ]
        ]
    ],
    //每个worker里需要预加载以共用的实例
    'concretes'  => [],
    //重置器
    'resetters'  => [],
    //每次请求前需要清空的实例
    'instances'  => [],
    //每次请求前需要重新执行的服务
    'services'   => [],
];
