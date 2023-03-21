<?php


namespace app\controller;


use app\BaseController;
use think\facade\Db;

class Mongo extends BaseController
{
    public function select()
    {
        $res = Db::connect('mongodb')
            ->table('test')
            ->limit(5)
            ->select()
            ->toArray();

        $res2 = Db::connect('mongodb')
            ->table('test')
            ->where('age', 18)
            ->where('name', 123)
            ->select();

        dd($res, json($res2));
    }

    public function insert()
    {
//        Db::connect('mongodb')
//            ->table('test')
//            ->insert(['name' => 123, 'age' => 18]);
        Db::connect('mongodb')
            ->table('test')
            ->insertGetId(['name' => 456, 'age' => 20]);
    }

    public function update()
    {
        Db::connect('mongodb')
            ->table('test')
            ->where('name', 456)
            ->update([
                'age' => 30
            ]);
    }

    public function del()
    {
        Db::connect('mongodb')
            ->table('test')
            ->where('name', 456)
            ->delete();

        Db::connect('mongodb')
            ->table('test')
            ->where('_id', '641822a7e7280000d600300e')
            ->delete();
    }
}