<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('info')
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('/resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($lastest as $l)
            <li><a href="{{url('article/'.$l->art_id)}}" title="{{$l->art_title}}"
                   target="_blank">{{$l->art_title}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($artview as $h)
            <li><a href="{{url('article/'.$h->art_id)}}" title="{{$h->art_title}}"
                   target="_blank">{{$h->art_title}}</a></li>
        @endforeach
    </ul>
    @show
<footer>
    {!! Config::get('web.copyright') !!}
</footer>
</body>
</html>