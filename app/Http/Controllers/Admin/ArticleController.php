<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommController;
use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        dd($input);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *PUT|PATCH     | admin/article/{article}
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *DELETE        | admin/article/{article}
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
