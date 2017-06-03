<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CommController;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


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


    public function jumppass()
    {
        return view('admin/pass');
    }

    public function modifypass()
    {
        if ($input = Input::all()) {
            $rule = [
                'password_o' => 'required',
                'password' => 'required|between:6,20|confirmed'
            ];

            $message = [
                'password_o.required' => '原密码不能为空！',
                'password.required' => '新密码不能为空!',
                'password.between' => '新密码位数需要在6到20位之间!',
                'password.confirmed' => '新密码输入的不一致，请重新输入!'
            ];

            $validate = Validator::make($input, $rule, $message);

            if ($validate->passes()) {
                $user = DB::table('user')->first();
                if ($input['password_o'] == decrypt($user->user_pwd)) {
                    $user->user_pwd = encrypt($input['password']);
//                    $user->update();//不起作用更新不了
                    DB::table('user')->where('user_id', $user->user_id)->update(['user_pwd' => $user->user_pwd]);
                    return redirect('admin/info');
                } else {
//                    return back()->with('errors', '原密码错误');//目前版本，这种方式不行了。
                    $errors = '原密码不正确！';
                    return back()->withErrors($errors);
                }
            } else {
                return back()->withErrors($validate);
            }


        } else {
            dd('meiyoushuru');
        }
    }


}
