<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CommController;


class IndexController extends CommController
{
    //登录成功后首页展示
    public function index()
    {
        return view('admin/index');
    }

    //登录成功后首页展示
    public function info()
    {
        return view('admin/info');
    }


}
