<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CommController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

require_once('App\org\code\Code.class.php');

class IndexController extends CommController
{
    //测试数据库连接
    public function index()
    {
        echo 231;
        $info = DB::connection()->getPdo();
        dd($info);
    }

    //后台登陆
    public function login()
    {
        if ($input = Input::all()) {
            $code = new \Code;
            $verifycode = $code->get();

            if (strtoupper($input['verify_code']) == $verifycode) {
                echo 'ok';
            } else {
                return back()->with('msg', '验证码错误');
            }
//                dd($input);
        } else {

            return view('admin.login');
        }
    }

//后台验证码生成
    public function verifycode()
    {
        $code = new \Code;
        $code->make();
    }

    public function getCode()
    {
        $code = new \Code;
        echo $code->get();
    }
}
