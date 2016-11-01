<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CommController;
use Illuminate\Support\Facades\DB;

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
}
