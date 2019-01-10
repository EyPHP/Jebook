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
                <legend>热烈祝贺Jebook 在百度SEO排名第四</legend>
        </fieldset>
        <div class="layui-row">
            <div id="LAY_demo1" class="layui-col-md12">
                <div class="layui-col-md12 book-info" style="border-bottom: 1px solid #f1f1f1;margin-bottom: 50px">
                    <p>经过两周多时间的艰苦奋斗，百度终于对Jebook进行收录了，然而360却还没收录，比较出人意外的是谷歌竟然收录达到了5个页面,jebook的关键词百度的收录竟然在首页的第四个。对于我们这种新建站点确实是不容易。我们的初衷是为更多人提供一个便捷的创作平台。所以希望大家推荐给更多人知道，跟多人去使用我们的平台。有问题可以联系我微信：QJWZYDSZ</p>
                </div>
                <img style="width: 100%" src="http://www.jebook.cn/assets/images/logo1.png" alt="热烈祝贺Jebook 在百度SEO排名第四">
                <div class="layui-col-md12 book-info" style="border-bottom: 1px solid #f1f1f1;margin-top: 50px">
                    <span>
                        作者：</span>{{str_limit('职业第三者',10,'...')}}
                        <span style="width: 20px;display: inline-block"></span>时间：2018年11月6日
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection