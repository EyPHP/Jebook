@extends('app.public.header')

@section('title', '一个简单便捷的创作平台')
@section('keywords', '博客,book,写小说,写博客,jebook,优秀个人创作平台')
@section('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷,优秀个人创作平台')

@section('content')
<style>
    .ahover:hover{
        color: #42cdef !important;
    }
</style>
<div class="site-banner">
    <div class="site-banner-bg" style="background-image: url({{ asset('/assets/images/banner.jpg')}}); background-size: cover;">
    </div>
    <div class="site-banner-main">
        <div class="site-zfj">
            <img src="{{ asset('assets/images/logo.png')}}" alt="Jebook 个人创作平台" style="width:246px;">
            {{--<i class="layui-icon" style="color: #fff; color: rgba(255,255,255,.7);">&#xe656;</i>--}}
        </div>
        <div class="layui-anim site-desc">
            <h1 class="web-font-desc">优秀个人创作平台</h1>
            <cite>为每个爱写作，喜欢记录生活的人提供了一个方便快捷的写作环境</cite>
        </div>
        <div class="site-download">
            <a href="/book/create.html" class="layui-inline site-down" target="_blank">
                <cite class="layui-icon">&#xe61f;</cite>
                马上创建
            </a>
        </div>
        <div class="site-version">
            <span>当前版本：<cite class="site-showv">1.0.0</cite></span>
            <span><a href="/log.html" rel="nofollow" target="_blank">更新日志</a></span>
            <span>用户量：<em class="site-showdowns">{{$userCount}}</em></span>
        </div>
        {{--<div class="site-banner-other">
            <a href="https://github.com/sentsin/layui/" target="_blank" class="site-star">
                <i class="layui-icon">&#xe658;</i>
                Star <cite id="getStars"></cite>
            </a>
            <a href="https://github.com/sentsin/layui/network/members" target="_blank" rel="nofollow" class="site-fork">
                <i class="layui-icon">&#xe62e;</i>
                Fork
            </a>
            <a href="https://gitee.com/sentsin/layui" target="_blank" rel="nofollow" class="site-fork">
                码云
            </a>
        </div>--}}
    </div>
</div>
<div class="layui-main">

    <ul class="site-idea">
        <li>
            <fieldset class="layui-elem-field layui-field-title">
                <legend>简洁美观</legend>
                <p>没有其他博客花哨，简单而不失美丽，像一本拿在手中的书。随刚翻随看。</p>
            </fieldset>
        </li>
        <li>
            <fieldset class="layui-elem-field layui-field-title">
                <legend>方便快速</legend>
                <p>随时写作，还可以创建多个作品。创建成功审核后即可写作，发布。还能拥有自己的特色域名。</p>
            </fieldset>
        </li>
        <li>
            <fieldset class="layui-elem-field layui-field-title">
                <legend>无门槛</legend>
                <p>各行各业的人都会看会写，无须担心不会写，不会操作。</p>
            </fieldset>
        </li>
    </ul>

</div>
<div class="layui-main">
    <ul class="site-idea">
        <li style="width: 1080px;">
            <fieldset class="layui-elem-field layui-field-title">
                <legend>最新动态</legend>
                <p>
                    <a class="ahover" href="http://www.jebook.cn/details.html?id=2" target="_blank" title="震惊！！没想到Jebook 是这样的东西,太可怕。"><span>{{str_limit('震惊！！没想到Jebook 是这样的东西,太可怕。',50,'...')}}</span></a>
                    <span style="float: right">
                    <span>
                        作者：</span>{{str_limit('职业第三者',10,'...')}}
                        <span style="width: 20px;display: inline-block"></span>时间：2018年11月8日
                    </span>
                </p>
                <p>
                    <a class="ahover" href="http://www.jebook.cn/details.html?id=1" target="_blank" title="热烈祝贺Jebook 在百度SEO排名第四"><span>{{str_limit('热烈祝贺Jebook 在百度SEO排名第四',50,'...')}}</span></a>
                    <span style="float: right">
                    <span>
                        作者：</span>{{str_limit('职业第三者',10,'...')}}
                        <span style="width: 20px;display: inline-block"></span>时间：2018年11月6日
                    </span>
                </p>
                <p>
                    <a class="ahover" href="/log.html" target="_blank" title="公告：Jebook 更新日志"><span>{{str_limit('公告：Jebook 更新日志',50,'...')}}</span></a>
                    <span style="float: right">
                    <span>
                        作者：</span>{{str_limit('职业第三者',10,'...')}}
                        <span style="width: 20px;display: inline-block"></span>时间：2018年10月12日
                    </span>
                </p>
            </fieldset>
        </li>
    </ul>

</div>

@endsection
