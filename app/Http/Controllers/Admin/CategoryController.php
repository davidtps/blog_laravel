<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommController;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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
     */
    public function create()
    {
        $data = Category::where('cat_pid', 0)->get();
//        return view('admin.category.add')->with('data',$data); //都可以
        return view('admin.category.add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *  post 操作请求URI:admin/cate
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $input = Input::except('_token');//不排除的话，使用creat我也可以填充到数据库，貌似不影响
//        dd($input);
        $rule = [
            'cat_name' => 'required',
        ];

        $message = [
            'cat_name.required' => '分类名称不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Category::create($input);
            if ($re) {
                return redirect('admin/cate');
            } else {
                return back()->withErrors('数据填充失败，请重新添加！');
            }

        } else {
            return back()->withErrors($validate);
        }

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
     */
    public function edit($id)
    {
//        $cate = Category::where('cat_id', $id)->get();//对应的是集合数据需要遍历才行！！！
        $cate = Category::find($id);//对应的类对象
        $data = Category::where('cat_pid', 0)->get();//分类数据
        if ($cate) {
            return view('admin.category.edit', compact('data', 'cate'));
        } else {
            return back()->withErrors('请求数据失败，请稍后再试！');
        }
    }

    /**
     * Update the specified resource in storage.
     *  PUT  URI:admin/cate/{cate}
     * @param  int $id
     */
    public function update($id)
    {
        $input = Input::except('_token','_method');//不排除的话，使用creat我也可以填充到数据库，貌似不影响
//        dd($input);
        $rule = [
            'cat_name' => 'required',
        ];

        $message = [
            'cat_name.required' => '分类名称不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Category::where('cat_id', $id)->update($input);
            if ($re) {
                return redirect('admin/cate');
            } else {
                return back()->withErrors('修改数据失败！');
            }

        } else {
            return back()->withErrors($validate);
        }
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
