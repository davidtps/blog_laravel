﻿@extends('layout.homeframe')
@section('info')
    <title>{{$field->cat_name.'-'.Config::get('web.seo_title')}}</title>
    <meta name="keywords" content="{{$field->cat_keywords}}"/>
    <meta name="description" content="{{$field->cat_desc}}"/>
@endsection
@section('content')
    <header>
        <div id="logo"><a href="/"></a></div>
        <nav class="topnav" id="topnav"> @foreach($navs as $v)<a
                    href="{{$v->nav_url}}"><span>{{$v->nav_name}}</span><span
                        class="en">{{$v->nav_alias}}</span></a> @endforeach    </nav>
    </header>
    <article class="blogs">
        <h1 class="t_nav"><span>{{$field->cat_title}}。</span><a href="/" class="n1">网站首页</a><a
                    href="{{url('/cate/'.$field->cat_id)}}"
                    class="n2">{{$field->cat_name}}</a>
        </h1>
        <div class="newblog left">

            @foreach($data as $v)
                <h2>{{$v->art_title}}</h2>
                <p class="dateview">
                    <span>发布时间：{{date('y-m-d',$v->art_time)}}</span><span>作者：{{$v->art_editor}}</span><span>分类：[<a
                                href="#">{{$field->cat_name}}</a>]</span></p>
                <figure><img src="{{url($v->art_thumb)}}"></figure>
                <ul class="nlist">
                    <p>{{$v->art_desc}}</p>
                    <a title="{{$v->art_title}}" href="{{url('/article/'.$v->art_id)}}" target="_blank"
                       class="readmore">阅读全文>></a>
                </ul>
                <div class="line"></div>

            @endforeach
            <div class="blank"></div>
            {{--<div class="ad">--}}
            {{--<img src="images/ad.png">--}}
            {{--</div>--}}
            <div class="page">
                {{$data->links()}}
            </div>
        </div>
        <aside class="right">
            @if($submenu->all())
                <div class="rnav">
                    <ul>
                        @foreach($submenu as $k=>$v)
                            <li class="rnav{{$k+1}}"><a href="{{url('cate/'.$v->cat_id)}}" target="_blank">{{$v->cat_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
        @endif
        <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a
                        class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span
                        class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585"></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date() / 3600000)
            </script>
            <!-- Baidu Button END -->
            <div class="news" style="float:left;">
                @parent
            </div>

        </aside>
    </article>
    <script type="text/javascript" src="{{asset('/resources/views/home/js/silder.js')}}"></script>
@endsection