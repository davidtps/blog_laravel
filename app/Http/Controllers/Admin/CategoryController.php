<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommController;
use App\Http\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends CommController
{
    /**
     * Display a listing of the resource.
     *  get  请求URI:admin/cate
     * //     * @return \Illuminate\Http\Response  //return 声明可以限制返回的数据类型，注掉后可以使用教程中的方式返回数据
     */
    public function index()
    {
        $category = Category::all();
//        dd($category);
//        return view('admin.category.index',compact('category'));
        return view('admin.category.index')->with('data', $category);
    }

    /**
     * Show the form for creating a new resource.
     *  GET RUI:admin/cate/create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *  post 操作请求URI:admin/cate
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *  GET  URI:admin/cate/{cate}
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET URI:admin/cate/{cate}/edit
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *  PUT  URI:admin/cate/{cate}
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
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
