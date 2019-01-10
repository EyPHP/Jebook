@extends('app.public.header')

@section('title', 'Jebook最新动态')
@section('keywords', '最新动态,book,写小说,写博客,jebook')
@section('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷')
<link rel="stylesheet" href="{{ asset('/h-admin/css/xadmin.css')}}">
<style>
    .layui-col-md3{
        padding: 5px;
    }
    .book-img{
        height: 180px;
    }
    .footer {
        position: relative;
        background-color: #f0f1f5;
        margin-top: 155px;
    }
    .book-info{
        height: 50px;
        padding: 15px 10px;
    }
    .layui-col-md3 a:hover{
        color: #000 !important;
    }
    .book-info a:hover{
        color: #42cdef !important;
    }
</style>
@section('content')
    <div class="layui-container">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>Jebook - 最新动态</legend>
        </fieldset>
        <div class="layui-row">
            <div id="LAY_demo1" class="layui-col-md12">
                <div class="layui-col-md12 book-info" style="border-bottom: 1px solid #f1f1f1;">
                    <a href="http://www.jebook.cn/details.html?id=2" target="_blank" title="震惊！！没想到Jebook 是这样的东西,太可怕。"><span>{{str_limit('震惊！！没想到Jebook 是这样的东西,太可怕。',30,'...')}}</span></a>
                    <span style="float: right">
                    <span>
                        作者：</span>{{str_limit('职业第三者',10,'...')}}
                        <span style="width: 20px;display: inline-block"></span>时间：2018年11月8日
                    </span>
                </div>
                <div class="layui-col-md12 book-info" style="border-bottom: 1px solid #f1f1f1;">
                    <a href="http://www.jebook.cn/details.html?id=1" target="_blank" title="热烈祝贺Jebook 在百度SEO排名第四"><span>{{str_limit('热烈祝贺Jebook 在百度SEO排名第四',30,'...')}}</span></a>
                    <span style="float: right">
                    <span>
                        作者：</span>{{str_limit('职业第三者',10,'...')}}
                        <span style="width: 20px;display: inline-block"></span>时间：2018年11月6日
                    </span>
                </div>
                <div class="layui-col-md12 book-info" style="border-bottom: 1px solid #f1f1f1;">
                    <a href="/log.html" target="_blank" title="公告：Jebook 更新日志"><span>{{str_limit('公告：Jebook 更新日志',30,'...')}}</span></a>
                    <span style="float: right">
                    <span>
                        作者：</span>{{str_limit('职业第三者',10,'...')}}
                        <span style="width: 20px;display: inline-block"></span>时间：2018年10月12日
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection