<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommController;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CategoryController extends CommController
{
    /**
     * Display a listing of the resource.
     *  get  请求URI:admin/cate
     *return 声明可以限制返回的数据类型，注掉后可以使用教程中的方式返回数据
     */
    public function index()
    {
        $data = (new Category())->handldTree();
//        dd($category);
//        return view('admin.category.index',compact('category'));
        return view('admin.category.index')->with('data', $data);
    }

    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cat_id']);
        $cate['cat_order'] = $input['order_value'];
//        $cate->cat_order = $input['order_value'];  //也可以
        $re = $cate->update();

        if ($re) {
            $data = [
                'status' => 0,
                'message' => '排序更新成功'
            ];
        } else {
            $data = [
                'status' => -1,
                'message' => '排序更新失败'
            ];
        }
        return $data;

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
