<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Navs;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class CommController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $navs = Navs::all();

        //最新文章 前6条
        $lastest = Article::orderBy('art_time', 'desc')->take(6)->get();
        //点击排行 前5条
        $artview = Article::orderBy('art_view', 'desc')->take(5)->get();


        View::share('navs', $navs);//构造方法是必走的，通过参数共享，实现视图共享参数
        View::share('lastest', $lastest);
        View::share('artview', $artview);
    }
}
