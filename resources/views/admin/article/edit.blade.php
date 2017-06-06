@extends('layout.frame')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;编辑分类
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        @if (count($errors) > 0)
            <div class="mark">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/cate/'.$cate->cat_id)}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>选择父类：</th>
                    <td>
                        <select name="cat_pid">
                            <option value="0">==顶级分类==</option>
                            @foreach($data as $v)
                                @if($cate->cat_pid == $v->cat_id)
                                    <option value="{{$v->cat_id}}" selected>{{$v->cat_name}}</option>
                                @else
                                    <option value="{{$v->cat_id}}">{{$v->cat_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类名称：</th>
                    <td>
                        <input type="text" class="lg" name="cat_name" value="{{$cate->cat_name}}"/>
                        <p>分类名称可以写10个字</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类标题：</th>
                    <td>
                        <input type="text" class="lg" name="cat_title" value="{{$cate->cat_title}}"/>
                        <p>标题可以写30个字</p>
                    </td>

                <tr>
                    <th>关键字：</th>
                    <td>
                        <textarea name="cat_keywords">{{$cate->cat_keywords}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="cat_desc">{{$cate->cat_desc}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" class="sm" name="cat_order" value="{{$cate->cat_order}}">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>

                </tbody>
            </table>
        </form>
    </div>

@endsection