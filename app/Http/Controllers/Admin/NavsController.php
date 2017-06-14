<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommController
{
    /**
     * Display a listing of the resource.
     * GET|HEAD      | admin/navs
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Navs::orderBy('nav_order', 'asc')->get();
        return view('admin.navs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *GET|HEAD      | admin/navs/create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.navs.add');
    }

    /**
     * Store a newly created resource in storage.
     *POST          | admin/navs
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $input = Input::except('_token');//不排除的话，使用creat我也可以填充到数据库，貌似不影响
//        dd($input);
        $rule = [
            'nav_name' => 'required',
            'nav_order' => 'required',
        ];

        $message = [
            'nav_name.required' => '友情链接名称不能为空！',
            'nav_order.required' => '排序id不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Navs::create($input);
            if ($re) {
                return redirect('admin/navs');
            } else {
                return back()->withErrors('导航数据填充失败，请重新添加！');
            }

        } else {
            return back()->withErrors($validate);
        }


    }

    /**
     * Display the specified resource.
     *GET|HEAD      | admin/navs/{link}
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *GET|HEAD      | admin/navs/{link}/edit
     * @param  int $id
     */
    public function edit($id)
    {
        $data = Navs::find($id);//对应的类对象
        if ($data) {
            return view('admin.navs.edit', compact('data'));
        } else {
            return back()->withErrors('请求数据失败，请稍后再试！');
        }
    }

    /**
     * Update the specified resource in storage.
     * PUT|PATCH     | admin/navs/{link}
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     */
    public function update(Request $request, $id)
    {
        $input = Input::except('_token', '_method');//不排除的话，使用creat我也可以填充到数据库，貌似不影响,必须排除
//        dd($input);
        $rule = [
            'nav_name' => 'required',
        ];

        $message = [
            'nav_name.required' => '名称不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Navs::where('nav_id', $id)->update($input);
            if ($re) {
                return redirect('admin/navs');
            } else {
                return back()->withErrors('修改数据失败！');
            }

        } else {
            return back()->withErrors($validate);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE        | admin/navs/{link}
     * @param  int $id
     */
    public function destroy($id)
    {
        $re = Navs::where('nav_id', $id)->delete();
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

    public function changeOrder()
    {
        $input = Input::all();
        $cate = Navs::find($input['nav_id']);
        $cate['nav_order'] = $input['order_value'];
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
}
