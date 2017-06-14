<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Navs;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $navs = Navs::all();
        \Illuminate\Support\Facades\View::share('navs', $navs);//构造方法是必走的，通过参数共享，实现视图共享参数
    }
}
