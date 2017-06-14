<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Category;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

class IndexController extends CommController
{
    public function index()
    {
//        $navs = Navs::all();
        return view('home.index');
    }

    public function cate()
    {
        return view('home.catelist');
    }

    public function artList()
    {
        return view('home.artlist');
    }
}
