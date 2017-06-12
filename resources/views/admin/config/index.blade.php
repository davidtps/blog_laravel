@extends('layout.frame')
@section('content')
    <script type="text/javascript" src="{{asset('/resources/views/admin/style/js/ch-ui.admin.js')}}"></script>

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 网站配置管理
    </div>
    <!--面包屑导航 结束-->


    <div class="result_wrap">
        @if (count($errors) > 0)
            <div class="mark">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
    @endif
    <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增网站配置</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部网站配置</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>
    <form action="{{url('admin/config/modifyContent')}}" method="post">
        {{csrf_field()}}
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>配置名称</th>
                        <th>配置标题</th>
                        <th>内容</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc">
                                <input type="text" onchange="changeOrder(this,{{$v->conf_id}})"
                                       value="{{$v->conf_order}}"/>
                            </td>
                            <td class="tc">{{$v->conf_id}}
                                <input type="hidden" name="conf_id[]" value="{{$v->conf_id}}"/>
                            </td>
                            <td>
                                <a href="#">{{$v->conf_name}}</a>
                            </td>
                            <td>{{$v->conf_title}}</td>
                            <td>{!! $v->_html !!}

                            </td>
                            <td>
                                <a href="{{url('admin/config/'.$v->conf_id.'/edit')}}">修改</a>
                                <a href="javascript:" onclick="deleteLinks({{$v->conf_id}})">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>


            </div>
            <div class="btn_group">
                <input type="submit" value="提交">
                <input type="button" class="back" onclick="history.go(-1)" value="返回">
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>
        function changeOrder(obj, conf_id) {
            var order_value = $(obj).val();
            $.post('{{url('admin/config/changeOrder')}}', {
                '_token': '{{csrf_token()}}',
                'conf_id': conf_id,
                'order_value': order_value
            }, function ($data) {
                if ($data['status'] == 0) {
                    layer.msg($data['message'], {icon: 6});
                } else {
                    layer.msg($data['message'], {icon: 5});
                }
            })
        }

        function deleteLinks(conf_id) {
            layer.confirm('确定要删除该分类么？', {
                btn: ['确定', '取消'] //可以无限个按钮
            }, function (index, layero) {
                $.post('{{url('admin/config')}}/' + conf_id,
                    {'_token': '{{csrf_token()}}', '_method': 'delete'},
                    function ($data) {
                        if ($data['status'] == 0) {
                            location.href = location.href;
                            layer.msg($data['message'], {icon: 6});
                        } else {
                            layer.msg($data['message'], {icon: 5});
                        }
                    });
            }, function (index) {

            });

        }
    </script>

@endsection