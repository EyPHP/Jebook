@extends('app.public.header')

@section('title', '个人中心')
@section('keywords', '个人中心,Jebook 登录,book,写小说,写博客,jebook')
@section('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷')

<style>
    .header{
        position: fixed !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
    }
    .layui-container{
        margin-top: 65px !important;
    }
    .personalMain{
        width: 928px;
        height: 548px;
        margin-left: 210px;
        background-color: #ffffff;
        border: #ebebeb solid 1px;
    }
    .grid-demo{
        background-color: rgba(255,255,255,0) !important;
        color: #000000 !important;
    }
    body{
        background-color: #f0f1f5;
    }
    .layui-btn{
        height: 27px !important;
        line-height: 20px !important;
    }
    .user p{
        height: 28px;
        line-height: 28px;
    }
    #msg{
        width: 200px;
        height: 38px;
        border-radius: 3px;
        background-color: #3f3f3f;
        position: absolute;
        color: #efef8f;
        line-height: 37px;
        padding-left: 14px;
        display: none;
        left: 80px;
    }
</style>
@section('content')

    <div class="layui-container">
        <div style="height: 20px"></div>
        <div class="layui-row">
            <ul style="float: left;padding: 15px 10px;height: 550px" class="layui-nav layui-nav-tree" lay-filter="test">
                <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="/personalCenter.html"><span style="padding-right: 5px"><i class="layui-icon">&#xe66f;</i></span></span>个人资料</a>
                </li>
                <li class="layui-nav-item">
                    <a href="/user/booklist.html"><span style="padding-right: 5px"><i class="layui-icon">&#xe705;</i></span>我的书籍</a>
                </li>
                {{--<li class="layui-nav-item">
                    <a href="">产品</a>
                </li>
                <li class="layui-nav-item">
                    <a href="">大数据</a>
                </li>--}}
            </ul>
            <div class="personalMain">
                <div class="layui-col-md12">
                    <div class="layui-col-xs6 layui-col-md12" style="height: auto">
                        <div class="grid-demo user" style="height: 150px;line-height: 150px;padding-left: 80px;padding-top:50px;text-align: left">
                            <p>姓名：{{$userModel->nickname}}</p>
                            <p>英文名：{{$userModel->username}}</p>
                            <p>邮箱：{{$userModel->email}}<span style="margin-left: 10px">
                                    @if($userModel->verify == 0)
                                    <a href="/verifyUser.html" target="_blank">
                                        <i id="icon" style="cursor: pointer" class="layui-icon">&#xe702;</i>
                                    </a>
                                    <span id="msg">邮箱未验证,点我可进行验证</span>
                                    @else
                                    <i class="layui-icon" style="color: #52d980">&#xe605;</i></span>
                                    @endif
                            </p>
                            <p>性别：{{$sex[$userModel->sex]}}</p>
                            <p>职业：{{$userModel->occupation}}</p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12" style="border-top: solid 1px #ebebeb;border-bottom: solid 1px #ebebeb;">
                    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
                        <div class="grid-demo">
                            <p>书籍 <span style="padding: 20px"></span> <a href="/book/create.html" target="_blank"><button class="layui-btn">去创建</button></a></p>
                            <p><a href="/user/booklist.html"><span style="font-size: 20px;color: red">{{$count}}</span></a><span>本</span></p>
                        </div>
                    </div>
                    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4" style="border-left: solid 1px #ebebeb;border-right: solid 1px #ebebeb;">
                        <div class="grid-demo">
                            <p>积分  <span style="padding: 20px"></span><button id="signin" @if(!$sigin) disabled readonly style="background-color: #636b6f" @endif class="layui-btn">@if(!$sigin)已签到@else签到@endif</button></p>
                            <p><span style="font-size: 20px;color: red" id="integral">{{$userModel->integral}}</span><span>分</span></p>
                        </div>
                    </div>
                    <div class="layui-col-xs4 layui-col-sm12 layui-col-md4">
                        <div class="grid-demo">
                            <p>等级 </p>
                            <p><span style="font-size: 20px;color: red" id="level">{{$userModel->level}}</span><span>初级会员</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
@endsection
<script src="{{ URL::asset('/assets/js/jquery.min.js')}}"></script>
<script>
    $(function () {
        $("#icon").hover(function () {
            $("#msg").show();
        },function () {
            $("#msg").hide();
        });

        $('#signin').click(
            function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: "json",
                    url: "/signin.html",
                    success: function (res) {
                        //console.log(res.errors.captcha);
                        if(res.code == 200){
                            $('#integral').html(res.data.integral);
                            $('#level').html(res.data.level);
                        }
                    }
                });
            }
        );
    });
</script>