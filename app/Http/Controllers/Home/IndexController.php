<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

class IndexController extends CommController
{
    public function index()
    {
        //图文6条文章数据
        $head = Article::orderBy('art_view', 'desc')->take(6)->get();
        //文章推荐  分页 每页5条
        $recommend = Article::orderBy('art_view', 'desc')->paginate(5);

        //友情链接 数据
        $links = Links::all();

        return view('home.index', compact('head', 'recommend', 'links'));
    }

    public function cate($cate_id)
    {

        //该类别下的文章数据 分页 每页4条
        $data = Article::where('cat_id', $cate_id)->orderBy('art_view', 'desc')->paginate(4);
        //改分类下的子类
        $submenu = Category::where('cat_pid',$cate_id)->get();
        //该分类的信息
        $field = Category::find($cate_id);

        return view('home.catelist',compact('data','field','submenu'));
    }

    public function article()
    {
        return view('home.article');
    }
}
