@extends('layout.frame')
@section('content')

    <script type="text/javascript" charset="utf-8" src="{{asset('/app/org/ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('/app/org/ueditor/ueditor.all.min.js')}}"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{asset('/app/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>

    {{--upload引入--}}
    {{--<script src="{{asset('/app/org/uploadify/jquery.uploadify.js')}}" type="text/javascript"></script>--}}
    {{--<link rel="stylesheet" type="text/css" href="{{asset('/app/org/uploadify/uploadify.css')}}">--}}
    <style>
        .edui-default {
            line-height: 28px;
        }

        div.edui-combox-body, div.edui-button-body, div.edui-splitbutton-body {
            overflow: hidden;
            height: 20px;
        }

        div.edui-box {
            overflow: hidden;
            height: 22px;
        }
    </style>

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;添加分类
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
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/article')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>选择类别：</th>
                    <td>
                        <select>
                            @foreach($data as $v)
                                <option value="{{$v->cat_id}}">{{$v->cat_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章标题：</th>
                    <td>
                        <input type="text" class="lg" name="article_title">
                    </td>
                </tr>
                <tr>
                    <th>文章作者：</th>
                    <td>
                        <input type="text" class="sm" name="alticle_editor">
                    </td>
                </tr>
                <tr>
                    <th>缩略图：</th>
                    <td><input type="text" id='thumb_url' style="width:300px;" name="thumb_url">
                        <input accept="image/*" id="file_upload" name="file_upload" type="file">

                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><img src="" id="img_thumb_show" style="max-width: 350px;max-height:100px">
                    </td>
                </tr>
                <tr>
                    <th>关键字：</th>
                    <td>
                        <input type="text" class="lg" name="article_keywords">
                    </td>
                </tr>
                <tr>
                    <th>文章描述：</th>
                    <td>
                        <textarea name="alticle_desc"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>文章内容：</th>
                    <td>
                        <script id="editor" type="text/plain" name="alticle_content"
                                style="width:800px;height:300px;"></script>

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
    <script type="text/javascript">
        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');


    </script>
    <script type="text/javascript">
        $('#file_upload').change(function () {  //选择文件
            var formData = new FormData($('form')[0]);
            $.ajax({
                url: '{{url('admin/article/upload')}}',  //server script to process data
                type: 'POST',
//                xhr: function () {  // custom xhr
//                    myXhr = $.ajaxSettings.xhr();
//                    if (myXhr.upload) { // check if upload property exists
//                        myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // for handling the progress of the upload
//                    }
//                    return myXhr;
//                },
                //Ajax事件
                beforeSend: function () { //开始上传
                    layer.msg('上传中,请稍后……');
                },
                success: function (data) {
                    layer.msg('上传成功');
                    $('#img_thumb_show').attr('src', data);
                    $('#thumb_url').val(data);
                },
                error: function () {
                    layer.msg('失败 ,请检查网络后重试');
                },
                // Form数据
                data: formData,
                //Options to tell JQuery not to process data or worry about content-type
                cache: false,
                contentType: false,
                processData: false
            });


        });
    </script>
@endsection