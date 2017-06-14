@extends('layout.adminframe')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;编辑配置
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
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增配置</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部配置</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/config').'/'.$data->conf_id}}" method="post">
            {{method_field('put')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>

                <tr>
                    <th><i class="require">*</i>配置标题：</th>
                    <td>
                        <input type="text" class="lg" name="conf_title" value="{{$data->conf_title}}"/>
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置标题必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>配置名称：</th>
                    <td>
                        <input type="text" class="lg" name="conf_name" value="{{$data->conf_name}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th>类型：</th>
                    <td>
                        @if($data->field_type == 'input')
                            <input type="radio" class="lg" name="field_type" value="input" checked onclick="showTr()">
                            input　
                            <input type="radio" class="lg" name="field_type" value="textarea" onclick="showTr()">
                            textarea　
                            <input type="radio" class="lg" name="field_type" value="radio" onclick="showTr()">radio
                        @elseif($data->field_type == 'textarea')
                            <input type="radio" class="lg" name="field_type" value="input" onclick="showTr()">input　
                            <input type="radio" class="lg" name="field_type" value="textarea" checked
                                   onclick="showTr()">textarea　
                            <input type="radio" class="lg" name="field_type" value="radio" onclick="showTr()">radio
                        @elseif($data->field_type == 'radio')
                            <input type="radio" class="lg" name="field_type" value="input" onclick="showTr()">input　
                            <input type="radio" class="lg" name="field_type" value="textarea" onclick="showTr()">
                            textarea　
                            <input type="radio" class="lg" name="field_type" value="radio" checked onclick="showTr()">
                            radio

                        @endif

                    </td>
                </tr>
                <tr class="custom">
                    <th>类型值：</th>
                    <td>
                        <input type="text" class="lg" name="field_value" value="{{$data->field_value}}">
                        <p><i class="fa fa-exclamation-circle yellow"></i>类型为radio时必填，格式：0|关闭,1|打开</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" class="sm" name="conf_order" value="{{$data->conf_order}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>说明：</th>
                    <td><textarea name="conf_tips">{{$data->conf_tips}}</textarea>
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
    <script>
        showTr();
        function showTr() {
            var type = $('input[name=field_type]:checked').val();
            if (type === "radio") {
                $('.custom').show();
            } else {
                $('.custom').hide();
            }
        }
    </script>
@endsection