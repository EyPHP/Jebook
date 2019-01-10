@section('title', 'Jebook 管理系统登录')
@section('keywords', 'Jebook 登录,book,写小说,写博客,jebook')
@section('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷')

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('css/basic.css')}}">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/iconfont.css')}}">
    <section role="main" id="flex-container" style="padding-top: 0px;background-image: url('{{ asset('img/admin.jpg')}}');background-size: 100%;">
        <div class="login-container">
            <div class="login">
                {{--<div class="loginItem login-lt">
                    <a href="javascript:;">
                        <img src="{{ asset('assets/images/login-b1.png')}}" alt="Jebook 登录">
                    </a>
                </div>--}}
                <div class="loginItem login-rt" style="margin: auto;background-color: #ffffff">
                    <div class="content">
                        <div class="contentItem">
                            <div class="itemTitle">
                                <h3>Jebook 后台管理系统</h3>
                            </div>
                            <form id="login-form">
                                <ul>
                                    <li class="itemEmail">
                                        <div class="input-normal">
                                            <input type="text" autocomplete="off" maxlength="200" name="username" value="" placeholder="用户名*">
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
                                            <p class="errorMsg">Please check your password!</p>
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
                                    {{--<li class="itemForget clearfix">
                                        <div class="input-normal forget clearfix">
                                            <a href="javascript:;">Forgot your password?</a>
                                            <span class="remember  fr">
                                                <span class="fr">Remember me</span>
                                                <input type="checkbox" name="remember" class="fr checkbox" id="checkbox-1" style="display: none;">
                                                 <label for="checkbox-1"></label>
                                            </span>
                                        </div>
                                    </li>--}}
                                    <li class="itemLogin">
                                        <button class="button-normal" type="button">LOGIN</button>
                                        <p class="errorMsg" style="color: #c01515;font-size: 12px;display: none;position: absolute;"></p>
                                    </li>
                                    {{--<li class="itemAccount">
                                        <span class="noAccount">
                                            No account? <span><a href="/register.html">Register now</a></span>
                                        </span>

                                    </li>--}}
                                </ul>
                            </form>
                            <div class="itemShare">


                            </div>
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
                $('input[name="username"]').siblings('.errorMsg').hide();
                $('input[name="captcha"]').siblings('.errorMsg').hide();
                $('input[name="password"]').siblings('.errorMsg').hide();
                $('.button-normal').siblings('.errorMsg').hide();
                var captcha = $('input[name="captcha"]').val();
                var email = $('input[name="username"]').val();

                /*if(!isEmail(email)){
                    $('input[name="email"]').siblings('.errorMsg').show();
                    return;
                }*/

                var password = $('input[name="password"]').val();

                if(!captcha){
                    $('input[name="captcha"]').siblings('.errorMsg').show();
                    return;
                }

                if(!password){
                    $('input[name="password"]').siblings('.errorMsg').show();
                    return;
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: "json",
                    data: 'username='+email+'&password='+password+'&captcha='+captcha,
                    url: "/admin/login.html",
                    success: function (res) {
                        //console.log(res.errors.captcha);
                        if(res.code != 200){
                            $('.button-normal').siblings('.errorMsg').html(res.msg).show();
                        }
                        $("#captchaImg").attr('src',"{{captcha_src()}}" + Math.random());
                        if(res.code == 200){
                            window.location.href = '/admin.html';
                        }
                    }
                });
            });
        })

        function isEmail(mail) {
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (filter.test(mail)) {
                return true;
            } else {
                return false;
            }
        }
    </script>
