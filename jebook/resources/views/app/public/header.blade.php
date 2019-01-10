<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jebook - @yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="baidu-site-verification" content="cjtlDzmPCt" />
    <meta name="format-detection" content="telephone=no">
    <meta name="360-site-verification" content="4d3f583be945b12ded8bfeec4db76d7c" />
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css')}}"  media="all">
    <link rel="stylesheet" href="{{ asset('css/global.css')}}"  media="all">
</head>
<body class="site-home" id="LAY_home" data-date="10-9">
<div class="layui-header header header-index" autumn>
    <div class="layui-main">
        <a class="logo" href="/">
            {{--<i class="layui-icon" style="color: #fff; color: rgba(255,255,255,.7);font-size: 36px;color: #FF9800;">&#xe656;</i>--}}
            <img src="{{ asset('assets/images/logo1.png')}}" alt="Jebook 个人创作平台">
        </a>
        <div class="layui-form component" lay-filter="LAY-site-header-component"></div>
        <ul class="layui-nav">
            <li class="layui-nav-item">
                <a href="/case.html" target="_blank">案例</a>
            </li>
            <li class="layui-nav-item">
                <a href="/news.html" target="_blank">新闻资讯</a>
            </li>
            <li class="layui-nav-item">
                <a href="/about.html" target="_blank">关于我们</a>
            </li>
            @if(Session::get('userInfo') != null)
                <li class="layui-nav-item" style="margin: 0px;margin-left: 20px">
                    <a href="/personalCenter.html" target="_blank" style="padding: 0 5px">欢迎回来，{{Session::get('userInfo')->nickname}}</a>
                </li>
                <li class="layui-nav-item" style="margin: 0px">
                    <a href="/logout.html" target="_blank" style="padding: 0 5px">退出</a>
                </li>
            @else
                <li class="layui-nav-item" style="margin: 0px;margin-left: 20px">
                    <a href="/login.html" target="_blank" style="padding: 0 5px">登录</a>
                </li>
                <li class="layui-nav-item" style="margin: 0px">
                    <a href="/register.html" target="_blank" style="padding: 0 5px">注册</a>
                </li>
            @endif
        </ul>
    </div>
</div>

@yield('content')

<div class="layui-footer footer footer-index">
    <div class="layui-main">
        <p>&copy; 2018 <a href="/">jebook.cn</a> MIT license</p>
        <p>
            <a href="/case.html" target="_blank">案例</a>
            {{--<a href="http://fly.layui.com/jie/3147/" target="_blank">支持</a>--}}
            <a href="/contact.html" site-event="contactInfo">联系我们</a>
            {{--<a href="https://github.com/sentsin/layui/" target="_blank" rel="nofollow">GitHub</a>
            <a href="https://gitee.com/sentsin/layui" target="_blank" rel="nofollow">码云</a>
            <a href="http://fly.layui.com/jie/2461/" target="_blank">微信公众号</a>--}}
            {{--<a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">粤ICP备13262562号-2</a>--}}
        </p>
        {{--<p class="site-union">
            <a href="https://www.upyun.com?from=layui" target="_blank" rel="nofollow" upyun><img src="picture/upyun.png"></a>
            <span>提供 CDN 赞助</span>
        </p>--}}
    </div>
</div>
</body>
</html>
{{--百度提交--}}
<script>
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
<script>(function(){
        var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?15f087e50403d6a20d9dc2ff3e010b53":"https://jspassport.ssl.qhimg.com/11.0.1.js?15f087e50403d6a20d9dc2ff3e010b53";
        document.write('<script src="' + src + '" id="sozz"><\/script>');
    })();
</script>