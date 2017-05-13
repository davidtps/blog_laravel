<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CommController;

use App\Http\Model\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

require_once('App\org\code\Code.class.php');

class LoginController extends CommController
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

//                $user = DB::select('select * from blog_user where user_id = :id', ['id' => 1]);
                $user = DB::table('user')->first();
//                echo $user->user_name ;
                if ($input['user_name'] != $user->user_name || decrypt($user->user_pwd) != $input['user_pwd']) {
                    return back()->with('msg', '用户名或密码错误');
                }
//                dd($user);
//                echo 'ok';
                session(['user' => $user]);
                return redirect('admin/index');
            } else {
                return back()->with('msg', '验证码错误');
            }
//                dd($input);
        } else {
//            dd($_SERVER);
//            phpinfo();
//            session(['user' => null]);
            return view('admin.login');
        }
    }

//后台验证码生成
    public function verifycode()
    {
        $code = new \Code;
        $code->make();
    }

//退出登录
    public function quit()
    {
        session(['user' => null]);
        return view('admin.login');
    }

//test
    public function encyty()
    {

        $str = '123456';
        echo encrypt($str);
    }
}
