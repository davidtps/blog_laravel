@extends('layout.adminframe')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;编辑导航信息
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
                <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>新增导航</a>
                <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>全部导航</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/navs/'.$data->nav_id)}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>导航名称：</th>
                    <td>
                        <input type="text" class="lg" name="nav_name" value="{{ $data->nav_name }}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>导航别名：</th>
                    <td>
                        <input type="text" class="lg" name="nav_alias" value="{{ $data->nav_alias}}">
                    </td>

                <tr>
                    <th>导航地址：</th>
                    <td>
                        <input type="text" class="lg" name="nav_url" value="{{ $data->nav_url}}">
                    </td>
                </tr>
                <tr>
                    <th><i class=" require">*</i>排序：
                    </th>
                    <td>
                        <input type="text" class="sm" name="nav_order" value="{{ $data->nav_order}}">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交"/>
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>

                </tbody>
            </table>
        </form>
    </div>

@endsection