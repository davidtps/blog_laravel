@extends('layout.frame')
@section('content')
    <script type="text/javascript" src="{{asset('/resources/views/admin/style/js/ch-ui.admin.js')}}"></script>
    <style>
        .result_content ul li span {
            padding: 6px 12px;
            text-decoration: none;
        }
    </style>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>文章标题</th>
                        <th>文章作者</th>
                        <th>点击次数</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc">
                                {{$v->art_id}}
                            </td>
                            <td class="tc">{{$v->art_title}}</td>
                            <td>
                                <a href="#">{{$v->art_editor}}</a>
                            </td>
                            <td>{{$v->art_view}}</td>
                            <td>{{date('Y-M-D  h-m-s',$v->art_time)}}</td>
                            <td>
                                <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                                <a href="javascript:" onclick="deleteArticle({{$v->art_id}})">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>


                <div class="page_list">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>

        function deleteArticle(art_id) {
            layer.confirm('确定要删除该文章么？', {
                btn: ['确定', '取消'] //可以无限个按钮
            }, function (index, layero) {
                $.post('{{url('admin/article')}}/' + art_id,
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