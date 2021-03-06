@extends('layout.adminframe')
@section('content')
    <script type="text/javascript" src="{{asset('/resources/views/admin/style/js/ch-ui.admin.js')}}"></script>

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 友情链接管理
    </div>
    <!--面包屑导航 结束-->

    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>新增友情链接</a>
                    <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>全部友情链接</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>链接名称</th>
                        <th>链接标题</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc">
                                <input type="text" name="ord[]" onchange="changeOrder(this,{{$v->link_id}})"
                                       value="{{$v->link_order}}"/>
                            </td>
                            <td class="tc">{{$v->link_id}}</td>
                            <td>
                                <a href="#">{{$v->link_name}}</a>
                            </td>
                            <td>{{$v->link_title}}</td>
                            <td>
                                <a href="{{url('admin/links/'.$v->link_id.'/edit')}}">修改</a>
                                <a href="javascript:" onclick="deleteLinks({{$v->link_id}})">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>


                {{--<div class="page_nav">--}}
                    {{--<div>--}}
                        {{--<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a>--}}
                        {{--<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>--}}
                        {{--<span class="current">8</span>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a>--}}
                        {{--<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a>--}}
                        {{--<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a>--}}
                        {{--<span class="rows">11 条记录</span>--}}
                    {{--</div>--}}
                {{--</div>--}}


                {{--<div class="page_list">--}}
                    {{--<ul>--}}
                        {{--<li class="disabled"><a href="#">&laquo;</a></li>--}}
                        {{--<li class="active"><a href="#">1</a></li>--}}
                        {{--<li><a href="#">2</a></li>--}}
                        {{--<li><a href="#">3</a></li>--}}
                        {{--<li><a href="#">4</a></li>--}}
                        {{--<li><a href="#">5</a></li>--}}
                        {{--<li><a href="#">&raquo;</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>
        function changeOrder(obj, link_id) {
            var order_value = $(obj).val();
            $.post('{{url('admin/links/changeOrder')}}', {
                '_token': '{{csrf_token()}}',
                'link_id': link_id,
                'order_value': order_value
            }, function ($data) {
                if ($data['status'] == 0) {
                    layer.msg($data['message'], {icon: 6});
                } else {
                    layer.msg($data['message'], {icon: 5});
                }
            })
        }

        function deleteLinks(link_id) {
            layer.confirm('确定要删除该分类么？', {
                btn: ['确定', '取消'] //可以无限个按钮
            }, function (index, layero) {
                $.post('{{url('admin/links')}}/' + link_id,
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