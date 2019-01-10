@extends('app.public.header')

@section('title', '热烈祝贺Jebook 在百度SEO排名第四 - Jebook')
@section('keywords', 'Jebook最新动态,book,写小说,写博客,Jebook')
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
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;border: 0px">
                <legend>震惊！！没想到Jebook 是这样的东西,太可怕。</legend>
        </fieldset>
        <div class="layui-row">
            <div id="LAY_demo1" class="layui-col-md12">
                <div class="layui-col-md12 book-info" style="border-bottom: 1px solid #f1f1f1;margin-bottom: 50px">
                    <p>
                        很多人会问Jebook是干嘛用的，收钱吗？创作平台？写博客写书的？有很多这样的平台了呀，我为什么要用你这个？
                    </p>
                    <p>
                        每次像这样的平台，网络上确实存在很多了，比如博客园,csdn等等，可是你喜欢那样的平台吗？没有一个是属于你自己的站点，广告天花乱坠，排版各种乱。而Jebook能给你的是他们所不能给你的，简洁大气，这个就够了，
                    </p>
                </div>
                <img style="width: 100%" src="http://www.jebook.cn/img/0001.jpg" alt="热烈祝贺Jebook 在百度SEO排名第四">
                <div class="layui-col-md12 book-info" style="border-bottom: 1px solid #f1f1f1;margin-top: 50px">
                    <span>
                        作者：</span>{{str_limit('职业第三者',10,'...')}}
                        <span style="width: 20px;display: inline-block"></span>时间：2018年11月8日
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection