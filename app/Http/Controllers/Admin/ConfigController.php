<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommController;
use App\Http\Model\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommController
{
    /**
     * Display a listing of the resource.
     * GET|HEAD      | admin/config
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Config::orderBy('conf_order', 'asc')->get();

        foreach ($data as $k => $v) {
            switch ($v->field_type) {
                case 'input':
                    $data[$k]->_html = "<input type=\"text\" class=\"lg\" name=\"conf_content[]\" value=\"$v->conf_content\">";
                    break;
                case 'textarea':
                    $data[$k]->_html = "<textarea  name=\"conf_content[]\">$v->conf_content</textarea>";
                    break;
                case 'radio':
                    $str = '';
                    $arr = explode(',', $v->field_value);
                    foreach ($arr as $m => $n) {
                        $arrin = explode('|', $n);
                        $check = '';
                        if ($v->conf_content == $arrin[0]) {
                            $check = ' checked ';
                        }

                        $str .= "<input type=\"radio\" class=\"lg\" name=\"conf_content[]\" $check value=\"$arrin[0]\" >$arrin[1]" . '　';
                    }
                    $data[$k]->_html = $str;
                    break;
            }
        }
        return view('admin.config.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *GET|HEAD      | admin/config/create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.config.add');
    }

    /**
     * Store a newly created resource in storage.
     *POST          | admin/config
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $input = Input::except('_token');//不排除的话，使用creat我也可以填充到数据库，貌似不影响
//        dd($input);
        $rule = [
            'conf_name' => 'required',
            'conf_order' => 'required',
        ];

        $message = [
            'conf_name.required' => '名称不能为空！',
            'conf_order.required' => '排序id不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Config::create($input);
            if ($re) {
                $this->putFile();
                return redirect('admin/config');
            } else {
                return back()->withErrors('配置数据填充失败，请重新添加！');
            }

        } else {
            return back()->withErrors($validate);
        }


    }

    /**
     * Display the specified resource.
     *GET|HEAD      | admin/config/{link}
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *GET|HEAD      | admin/config/{link}/edit
     * @param  int $id
     */
    public function edit($id)
    {
        $data = Config::find($id);//对应的类对象
        if ($data) {
            return view('admin.config.edit', compact('data'));
        } else {
            return back()->withErrors('请求数据失败，请稍后再试！');
        }
    }

    /**
     * Update the specified resource in storage.
     * PUT|PATCH     | admin/config/{link}
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     */
    public function update(Request $request, $id)
    {
        $input = Input::except('_token', '_method');//不排除的话，使用creat我也可以填充到数据库，貌似不影响,必须排除
//        dd($input);
        $rule = [
            'conf_name' => 'required',
        ];

        $message = [
            'conf_name.required' => '名称不能为空！',
        ];

        $validate = Validator::make($input, $rule, $message);

        if ($validate->passes()) {
            $re = Config::where('conf_id', $id)->update($input);
            if ($re) {
                $this->putFile();
                return redirect('admin/config');
            } else {
                return back()->withErrors('修改数据失败！');
            }

        } else {
            return back()->withErrors($validate);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE        | admin/config/{link}
     * @param  int $id
     */
    public function destroy($id)
    {
        $re = Config::where('conf_id', $id)->delete();
        if ($re) {
            $this->putFile();
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
        dd($input);
        $cate = Config::find($input['conf_id']);
        $cate['conf_order'] = $input['order_value'];
//        $cate->cat_order = $input['order_value'];  //也可以
        $re = $cate->update();

        if ($re) {
            $data = [
                'status' => 0,
                'message' => '网站配置排序更新成功'
            ];
        } else {
            $data = [
                'status' => -1,
                'message' => '网站配置排序更新失败'
            ];
        }
        return $data;
    }

    public function modifyContent()
    {
        $input = Input::all();
        $tip = '';
        foreach ($input['conf_id'] as $k => $v) {

            $re = Config::where('conf_id', $v)->update(['conf_content' => $input['conf_content'][$k]]);
            if ($re == 0) {
                $tip = '修改成功';
            } else {
                $tip = '修改失败';
            }
        }
        return back()->withErrors($tip);
    }

    public function putFile()
    {
        echo \Illuminate\Support\Facades\Config::get('web.web_title');
        $data = Config::pluck('conf_title', 'conf_name')->all();
//        dd($data);
//        var_dump($data);
        $path = base_path() . '\config\web.php';
//        echo $path;
        $str = "<?PHP return " . var_export($data, true) . ";";
        file_put_contents($path, $str);//第一个参数路径，第二个才是值
    }
}
