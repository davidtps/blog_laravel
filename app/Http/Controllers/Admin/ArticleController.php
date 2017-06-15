<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommController
{

    public function upload()
    {
        $file = Input::file('file_upload');
//        dd($file);
        if ($file->isValid()) {
            $realPath = $file->getRealPath();
            $entension = $file->getClientOriginalExtension();//上传文件的后缀
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
            $path = $file->move(base_path() . '/uploads', $newName);
            return '/uploads/' . $newName;
        }
    }

    /**
     * Display a listing of the resource.
     *GET|HEAD      | admin/article
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::orderBy('art_id', 'desc')->paginate(5);
        return view('admin.article.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *GET|HEAD      | admin/article/create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = (new Category())->handldTree();
        return view('admin.article.add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *POST          | admin/article
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $input = Input::except('file_upload', '_token');
        $input['art_time'] = time();//date('Y-M-D:h-m-s');


        $rule = [
            'art_title' => 'required',
            'art_content' => 'required',
        ];

        $message = [
            'art_title.required' => '文章标题不能为空！',
            'art_content.required' => '文章内容不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Article::create($input);
            if ($re) {
                return redirect('admin/article');
            } else {
                return back()->withErrors('数据填充失败，请重新添加！');
            }

        } else {
            return back()->withErrors($validate);
        }

    }

    /**
     * Display the specified resource.
     *GET|HEAD      | admin/article/{article}
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *GET|HEAD      | admin/article/{article}/edit
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $data = (new Category())->handldTree();//分类数据
        return view('admin.article.edit', compact('article', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *PUT|PATCH     | admin/article/{article}
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     */
    public function update( $id)
    {
        $input = Input::except('_token','_method','file_upload');
        $rule = [
            'art_title' => 'required',
        ];

        $message = [
            'art_title.reitquired' => '文章标题不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Article::where('art_id', $id)->update($input);
            if ($re) {
                return redirect('admin/article');
            } else {
                return back()->withErrors('修改数据失败,请稍后重试！');
            }

        } else {
            return back()->withErrors($validate);
        }
    }

    /**
     * Remove the specified resource from storage.
     *DELETE        | admin/article/{article}
     * @param  int $id
     */
    public function destroy($id)
    {
        $re = Article::where('art_id', $id)->delete();
        if ($re) {
            $data = [
                'status' => 0,
                'message' => '删除成功'
            ];
        } else {
            $data = [
                'status' => -1,
                'message' => '删除失败'
            ];
        }
        return $data;

    }
}
