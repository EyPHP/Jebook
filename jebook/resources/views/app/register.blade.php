@extends('app.public.header')

@section('title', '注册')
@section('keywords', 'Jebook 注册,book,写小说,写博客,jebook')
@section('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷')

<style>
    input[type='radio'].radio {opacity:0;position: absolute;}
    label.radio {cursor: pointer; font-size:14px;min-width:80px;display:block; -webkit-appearance: none;background-color:#FAFAFA;border:1px solid #CCCCCC;color: #333333;height:28px;line-height: 28px;margin: 5px; text-align: center;padding: 0 5px;}
    input[type='radio'].radio:checked + .radio {background-color:#2095F2;border:1px solid #2095F2;color: #fff;}
</style>
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link rel="stylesheet" href="{{ asset('css/basic.css')}}">
<link rel="stylesheet" href="{{ asset('css/login.css')}}">
<link rel="stylesheet" href="{{ asset('assets/fonts/iconfont.css')}}">
<section role="main" id="flex-container" style="padding-top: 3rem">
    <div class="login-container">
        <div class="login">
            <div class="loginItem login-lt">
                <a href="javascript:;">
                    <img style="height:650px;" src="{{ asset('assets/images/login-b1.png')}}" alt="Jebook 注册">
                </a>
            </div>
            <div class="loginItem login-rt">
                <div class="content">
                    <div class="contentItem">
                        <div class="itemTitle">
                            <h3>CREATE ACCOUNT</h3>
                        </div>
                        <form id="register-form">
                            <ul>
                                <li class="itemName">
                                    <div class="input-normal">
                                        <input type="text" autocomplete="off" maxlength="200" name="nickname" value="" placeholder="真实姓名*">
                                        <span class="m-loginDelete">
                                                <i class="iconfont icon-Eachine_delete"></i>
                                            </span>
                                        <p class="errorMsg">Please check your name!</p>
                                    </div>
                                </li>
                                <li class="itemName">
                                    <div class="input-normal">
                                        <input type="text" autocomplete="off" maxlength="200" name="username" value="" placeholder="英文名称*">
                                        <span class="m-loginDelete">
                                                <i class="iconfont icon-Eachine_delete"></i>
                                            </span>
                                        <p class="errorMsg">Please check your name!</p>
                                    </div>
                                </li>
                                <li class="itemEmail">
                                    <div class="input-normal">
                                        <input type="text" autocomplete="off" maxlength="200" name="email" value="" placeholder="邮箱*">
                                        <span class="m-loginDelete">
                                                <i class="iconfont icon-Eachine_delete"></i>
                                            </span>
                                        <p class="errorMsg">Please check your email address format!</p>
                                    </div>
                                </li>
                                <li class="itemPassword">
                                    <div class="input-normal">
                                        <input type="password" autocomplete="off" maxlength="200" name="password" value="" placeholder="密码*">
                                        <span class="m-loginDelete">
                                                <i class="iconfont icon-Eachine_delete"></i>
                                            </span>
                                        <p class="errorMsg">Please enter password between 6-20 characters.</p>
                                    </div>
                                </li>
                                <li class="itemConfirmPassword*">
                                    <div class="input-normal">
                                        <input type="password" autocomplete="off" maxlength="200" name="repassword" value="" placeholder="重复密码*">
                                        <span class="m-loginDelete">
                                                <i class="iconfont icon-Eachine_delete"></i>
                                            </span>
                                        <p class="errorMsg">密码不一致.</p>
                                    </div>
                                </li>
                                <li class="itemName">
                                    <div class="input-normal">
                                        女&nbsp;&nbsp;<input type="radio" name="sex" value="1" title="女" style="width: 24px;cursor: pointer" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;
                                        男&nbsp;&nbsp;<input type="radio" name="sex" value="2" title="男" style="width: 24px;cursor: pointer">
                                    </div>
                                </li>
                                <li class="itemName">
                                    <div class="input-normal">
                                        <input type="text" autocomplete="off" maxlength="200" name="occupation" value="" placeholder="职业">
                                        <span class="m-loginDelete">
                                                <i class="iconfont icon-Eachine_delete"></i>
                                            </span>
                                        <p class="errorMsg">Please check your name!</p>
                                    </div>
                                </li>
                                <li class="itemVerify">
                                    <div class="input-normal verifyCode">
                                        <input type="text" autocomplete="off" maxlength="200" name="captcha" value="" placeholder="验证码*">
                                        <span class="verifyImg fr">
                                                <img id="captchaImg" src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()" alt="Jebook 验证码">
                                            </span>
                                        <p class="errorMsg">验证码不能为空</p>
                                    </div>
                                </li>
                                <li class="itemLogin">
                                    <button class="button-normal" type="button">REGISTER</button>
                                    <p class="errorMsg" style="color: #c01515;font-size: 12px;display: none;position: absolute;"></p>
                                </li>
                                <li class="itemGoLogin">
                                    <div class="goLogin">
                                        <a href="/login.html">< Login</a>
                                    </div>
                                </li>
                            </ul>
                        </form>

                    </div>


                </div>
            </div>
        </div>

    </div>
</section>
<script src="{{ URL::asset('/assets/js/jquery.min.js')}}"></script>
    <script>
        $(function () {
            $('.button-normal').click(function () {
                $('input[name="nickname"]').siblings('.errorMsg').hide();
                $('input[name="username"]').siblings('.errorMsg').hide();
                $('input[name="email"]').siblings('.errorMsg').hide();
                $('input[name="captcha"]').siblings('.errorMsg').hide();
                $('input[name="password"]').siblings('.errorMsg').hide();
                $('input[name="repassword"]').siblings('.errorMsg').hide();

                $('.button-normal').siblings('.errorMsg').hide();

                var nickname = $('input[name="nickname"]').val();
                var captcha = $('input[name="captcha"]').val();
                var email = $('input[name="email"]').val();
                var username = $('input[name="username"]').val();
                var occupation = $('input[name="occupation"]').val();
                var sex = $('input[name="sex"]:checked').val();

                /*if(!isEmail(email)){
                    $('input[name="email"]').siblings('.errorMsg').show();
                    return;
                }

                if(!checkWord(username)){
                    $('input[name="username"]').siblings('.errorMsg').show();
                    return false;
                }*/

                var password = $('input[name="password"]').val();
                var repassword = $('input[name="repassword"]').val();

                if(!username){
                    $('input[name="username"]').siblings('.errorMsg').show();
                    return;
                }
                if(!password){
                    $('input[name="password"]').siblings('.errorMsg').show();
                    return;
                }

                if(password != repassword){
                    $('input[name="repassword"]').siblings('.errorMsg').show();
                    return;
                }

                if(!captcha){
                    $('input[name="captcha"]').siblings('.errorMsg').show();
                    return;
                }

                if(!password){
                    $('input[name="password"]').siblings('.errorMsg').show();
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: "json",
                    data: 'email='+email+'&nickname='+nickname+'&password='+password+'&captcha='+captcha+'&username='+username+'&repassword='+repassword+'&sex='+sex+'&occupation='+occupation,
                    url: "/register.html",
                    success: function (res) {
                        if(res.code != 200){
                            $('.button-normal').siblings('.errorMsg').html(res.msg).show();
                        }

                        $("#captchaImg").attr('src',"{{captcha_src()}}" + Math.random());
                        if(res.code == 200){
                            window.location.href = res.data.uri;
                        }
                    }
                });
            });
        });

        function isEmail(mail) {
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (filter.test(mail)) {
                return true;
            } else {
                return false;
            }
        }
        function checkWord(nubmer)
        {
            var re =  /^[0-9a-zA-Z]*$/;
            if (!re.test(nubmer)){
                return false;
            }else{
                return true;
            }
        }
    </script>
@endsection