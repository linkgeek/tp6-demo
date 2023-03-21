<?php

namespace app\controller;

use think\swoole\Table;
use Swoole\Table as SwooleTable;
use app\BaseController;
use think\Container;
use database\MysqlPool;


class Test extends BaseController
{
    public function index()
    {
        return 'test-index';
    }

    public function hello()
    {
        return 'hello,';
    }

    public function register(\Swoole\Server $server)
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            //TODO 调用验证类验证数据
            //TODO 将注册信息插入数据库

            // 这里调用 Task 异步任务
            $server->task(\app\listener\SwooleTask::class);
            // 方式二
//            $manager = app('\think\swoole\Manager');
//            $manager -> getServer() -> task(\app\listener\SwooleTask::class);

            return "注册成功！" . time();
        }
    }

    public function task()
    {
        $manager = app('\think\swoole\Manager');
        $data = ['task' => 'sms', 'data' => []];
        $res = $manager->getServer()->task($data);
    }

    public function table()
    {
        //拿到实例化后的table对象
        $make = app()->make(Table::class);

        //获取user示意例
        /** @var SwooleTable $table * */
        $table = $make->get('user');

        //设置数据
        $table->set('1', ['fd' => 123, 'type' => 1, 'uid' => 1, 'to_uid' => 0, 'tourist' => 0]);

        //读取key=1的数据
        $table->get('1');

        foreach ($table as $key => $value) {
            var_dump($key); //设置的key
            var_dump($value); //设置的value数据
        }
    }

    public function dbPool()
    {
        // 获取容器实例
        $container = Container::getInstance();

        // 注册连接池
        $container->bind('db', function () {
            return new MysqlPool();
        });

        // 获取数据库连接
        $db = $container->make('db')->getConnection();
        var_dump($db);
    }
}
