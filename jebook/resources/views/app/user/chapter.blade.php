@extends('app.public.header')

@section('title', '个人中心')
@section('keywords', '个人中心,Jebook 登录,book,写小说,写博客,jebook')
@section('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷')

<style>
    body{
        background-color: #f0f1f5;
    }
    .header{
        position: fixed !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
    }
    .user p{
        height: 28px;
        line-height: 28px;
    }
    .layui-colla-content {
        padding: 10px 35px !important;
    }
</style>
@section('content')

    <div class="layui-container"  style="margin-top: 65px;">
        <div style="height: 20px"></div>
        <div class="layui-row">
            <ul style="float: left;padding: 15px 10px;height: 550px" class="layui-nav layui-nav-tree" lay-filter="test">
                <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
                <li class="layui-nav-item">
                    <a href="/personalCenter.html"><span style="padding-right: 5px"><i class="layui-icon">&#xe66f;</i></span></span>个人资料</a>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="/user/booklist.html"><span style="padding-right: 5px"><i class="layui-icon">&#xe705;</i></span>我的书籍</a>
                </li>
                {{--<li class="layui-nav-item">
                    <a href="">产品</a>
                </li>
                <li class="layui-nav-item">
                    <a href="">大数据</a>
                </li>--}}
            </ul>
            <div class="layui-container" style="padding: 20px 20px;border: #ebebeb solid 1px;width: 930px;background-color: #ffffff;float: left;margin-left: 10px">
                <xblock>
                    <button class="layui-btn"><a style="color: #fff" href="/user/booklist.html">返回书籍</a></button>
                    <button class="layui-btn"><a style="color: #fff" target="_blank" href="/article/edit?book_id={{$book_id}}">添加章节</a></button>
                </xblock>
                <div class="layui-col-md12">
                    <fieldset class="layui-elem-field layui-field-title">
                    <legend>书籍：{{$book_name}} <span style="font-size: 12px">共有数据：{{$count}} 条</span></legend>
                </fieldset>
                    <div class="layui-collapse" lay-accordion="">
                        @foreach ($data as $k1 => $val1)
                        <div class="layui-colla-item">
                            @if($k1 != 'null')
                            <h2 class="layui-colla-title">{{$k1}}</h2>
                            @foreach ($val1['data'] as $dk1 => $dv1)
                            <div class="layui-colla-content">
                                <a target="_blank" style="color: #1E9FFF" href="/">{{$dv1->title}}</a>
                                <span style="float: right">
                                    <a href="/article/edit?book_id={{$book_id}}&id={{$dv1->id}}" target="_blank">编辑</a>
                                </span>
                            </div>
                            @endforeach
                            @if(!empty($val1['sub']))
                                <div class="layui-colla-content">
                                    <div class="layui-collapse" lay-accordion="">
                                        @foreach ($val1['sub'] as $k2 => $val2)
                                        <div class="layui-colla-item">
                                            <h2 class="layui-colla-title">{{$k2}}</h2>
                                            @foreach ($val2['data'] as $dk2 => $dv2)
                                                <div class="layui-colla-content">
                                                    <a target="_blank" style="color: #1E9FFF" href="/">{{$dv2->title}}</a>
                                                    <span style="float: right">
                                                        <a href="/article/edit?book_id={{$book_id}}&id={{$dv2->id}}" target="_blank">编辑</a>
                                                    </span>
                                                </div>
                                            @endforeach
                                            @if(!empty($val2['sub']))
                                            <div class="layui-colla-content">

                                                <div class="layui-collapse" lay-accordion="">
                                                    @foreach ($val2['sub'] as $k3 => $val3)
                                                    <div class="layui-colla-item">
                                                        <h2 class="layui-colla-title">{{$k3}}</h2>
                                                        @foreach ($val3['data'] as $dk3 => $dv3)
                                                            <div class="layui-colla-content">
                                                                <a target="_blank" style="color: #1E9FFF" href="/">{{$dv3->title}}</a>
                                                                <span style="float: right">
                                                                    <a href="/article/edit?book_id={{$book_id}}&id={{$dv3->id}}" target="_blank">编辑</a>
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                        @if(!empty($val3['sub']))
                                                        <div class="layui-colla-content">
                                                            <div class="layui-collapse" lay-accordion="">
                                                                @foreach ($val3['sub'] as $k4 => $val4)
                                                                <div class="layui-colla-item">
                                                                    <h2 class="layui-colla-title">{{$k4}}</h2>
                                                                    @foreach ($val4['data'] as $dk4 => $dv4)
                                                                        <div class="layui-colla-content">
                                                                            <a target="_blank" style="color: #1E9FFF" href="/">{{$dv4->title}}</a>
                                                                            <span style="float: right">
                                                                                <a href="/article/edit?book_id={{$book_id}}&id={{$dv4->id}}" target="_blank">编辑</a>
                                                                            </span>
                                                                        </div>
                                                                    @endforeach
                                                                    @if(!empty($val4['sub']))
                                                                    <div class="layui-colla-content">
                                                                        <div class="layui-collapse" lay-accordion="">
                                                                            @foreach ($val4['sub'] as $k5 => $val5)
                                                                            <div class="layui-colla-item">
                                                                                <h2 class="layui-colla-title">{{$k5}}</h2>
                                                                                @foreach ($val5['data'] as $dk5 => $dv5)
                                                                                    <div class="layui-colla-content">
                                                                                        <a target="_blank" style="color: #1E9FFF" href="/">{{$dv5->title}}</a>
                                                                                        <span style="float: right">
                                                                                            <a href="/article/edit?book_id={{$book_id}}&id={{$dv5->id}}" target="_blank">编辑</a>
                                                                                        </span>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endif
                            @else
                                @foreach ($val1['data'] as $dk1 => $dv1)
                                    <div class="layui-colla-content" style="display: block;padding: 10px 17px;">
                                        <a target="_blank" style="color: #1E9FFF" href="/">{{$dv1->title}}</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
@endsection
<script src="{{ URL::asset('/assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('/layui/layui.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{ asset('/h-admin/js/xadmin.js')}}"></script>
<script>
    $(function () {
        layui.use('laydate', function(){
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });
    });
</script>