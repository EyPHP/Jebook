@extends('app.public.header')

@section('title', '联系我们 Jebook')
@section('keywords', '联系我们,Jebook, 更新日志,book,写小说,写博客,jebook')
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
        color: #000 !important;
    }
    .name{
        font-weight: bold;
        font-size: 16px;
        line-height: 20px;
    }

    .time{
        color: #666;
        line-height: 20px;
    }
    .reply-content{

    }
    .reply{
        color: #6f84b8;
    }
</style>

@section('content')
    <div class="layui-container">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>Jebook - 精选留言</legend>
        </fieldset>
        <div class="layui-row">
            <form class="layui-form">
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">名字</label>
                    <div class="layui-input-block">
                        <input name="name" id="name" style="width: 40%" placeholder="请输入内容" class="layui-input"></input>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">留言</label>
                    <div class="layui-input-block">
                        <textarea name="content" id="content" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <span class="layui-btn" lay-filter="formDemo">立即提交</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="layui-row">
            <div id="LAY_demo1" class="layui-col-md12" style="width: 1030px">
                @foreach ($data as $value)

                <div class="layui-col-md12" style="margin-left: 110px;padding-top:15px;padding-bottom: 15px;border-bottom: #ebebeb solid 1px;">
                    <div class="layui-col-md12">
                        <p class="name">{{$value->name}}</p>
                        <p class="time"><span>{{$value->create_time}}</span></p>
                        <p class="mag">{{$value->content}}。</p>
                    </div>
                    @if($value->reply != '')
                    <div class="layui-col-md12" style="padding-left: 30px;padding-top: 10px;">
                        <P>
                            <span class="reply">回复</span>：<span class="reply-content">{{$value->reply}}</span>
                        </P>
                    </div>
                    @endif
                </div>
                @endforeach
                {{--@foreach ($bookList as $value)

                    <div class="layui-col-md3">
                        <a href="http://{{$value->domain}}" target="_blank">
                            <div class="layui-col-md12 book-img" style="background-color: #1E9FFF">

                            </div>
                        </a>
                        <div class="layui-col-md12 book-info" style="background-color:#f0ad4e">
                            <a href="http://{{$value->domain}}" target="_blank"><span>{{str_limit($value->book_name,18,'...')}}</span></a>
                            <span style="float: right">
                        <span>作者：</span>{{str_limit($value->User->nickname,10,'...')}}
                        </span>
                        </div>
                    </div>
                @endforeach--}}
            </div>
            <div class="page">
                <div>
                    {{--{{$bookList->links()}}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ URL::asset('/assets/js/jquery.min.js')}}"></script>
<script>
    $(function () {
        $('.layui-btn').click(function () {
            var content = $('#content').val();
            if(!content){
                alert('内容不能为空');
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                dataType: "json",
                data: 'content='+content+'&name='+$("#name").val(),
                url: "/contact/add",
                success: function (res) {
                    if(res.code == 200){
                        window.location.reload();
                    }
                }
            });
        });
    });

</script>