<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CommController;

use Illuminate\Support\Facades\DB;

require_once('App\org\code\Code.class.php');

class IndexController extends CommController
{
    //
    public function index()
    {
        echo 231;
        $info = DB::connection()->getPdo();
        dd($info);
    }

    //
    public function login()
    {
        return view('admin.login');
    }

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
