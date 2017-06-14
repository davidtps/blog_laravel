<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class LinksController extends CommController
{
    /**
     * Display a listing of the resource.
     * GET|HEAD      | admin/links
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Links::orderBy('link_order', 'asc')->get();
        return view('admin.links.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *GET|HEAD      | admin/links/create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.links.add');
    }

    /**
     * Store a newly created resource in storage.
     *POST          | admin/links
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $input = Input::except('_token');//不排除的话，使用creat我也可以填充到数据库，貌似不影响
//        dd($input);
        $rule = [
            'link_name' => 'required',
            'link_order' => 'required',
        ];

        $message = [
            'link_name.required' => '友情链接名称不能为空！',
            'link_order.required' => '排序id不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Links::create($input);
            if ($re) {
                return redirect('admin/links');
            } else {
                return back()->withErrors('友情链接数据填充失败，请重新添加！');
            }

        } else {
            return back()->withErrors($validate);
        }


    }

    /**
     * Display the specified resource.
     *GET|HEAD      | admin/links/{link}
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *GET|HEAD      | admin/links/{link}/edit
     * @param  int $id
     */
    public function edit($id)
    {
        $data = Links::find($id);//对应的类对象
        if ($data) {
            return view('admin.links.edit', compact('data'));
        } else {
            return back()->withErrors('请求数据失败，请稍后再试！');
        }
    }

    /**
     * Update the specified resource in storage.
     * PUT|PATCH     | admin/links/{link}
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     */
    public function update(Request $request, $id)
    {
        $input = Input::except('_token', '_method');//不排除的话，使用creat我也可以填充到数据库，貌似不影响,必须排除
//        dd($input);
        $rule = [
            'link_name' => 'required',
        ];

        $message = [
            'link_name.required' => '名称不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Links::where('link_id', $id)->update($input);
            if ($re) {
                return redirect('admin/links');
            } else {
                return back()->withErrors('修改数据失败！');
            }

        } else {
            return back()->withErrors($validate);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE        | admin/links/{link}
     * @param  int $id
     */
    public function destroy($id)
    {
        $re = Links::where('link_id', $id)->delete();
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
        $cate = Links::find($input['link_id']);
        $cate['link_order'] = $input['order_value'];
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
