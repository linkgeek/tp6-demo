<?php

namespace app\controller;


use app\BaseController;


class Index extends BaseController
{
    public function index()
    {
        return 'index-index';
    }

    public function hello($name = '111')
    {
        return 'hello, ' . $name;
    }
}
