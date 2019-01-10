

<?php $__env->startSection('title', '登录'); ?>
<?php $__env->startSection('keywords', 'Jebook 登录,book,写小说,写博客,jebook'); ?>
<?php $__env->startSection('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷'); ?>

<?php $__env->startSection('content'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?php echo e(asset('css/basic.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/fonts/iconfont.css')); ?>">
<section role="main" id="flex-container">
    <div class="login-container">
        <div class="login">
            <div class="loginItem login-lt">
                <a href="javascript:;">
                    <img src="<?php echo e(asset('assets/images/login-b1.png')); ?>" alt="Jebook 登录">
                </a>
            </div>
            <div class="loginItem login-rt">
                <div class="content">
                    <div class="contentItem">
                        <div class="itemTitle">
                            <h3>WELCOME BACK</h3>
                        </div>
                        <form id="login-form">
                            <ul>
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
                                        <p class="errorMsg">Please check your password!</p>
                                    </div>
                                </li>
                                <li class="itemVerify">
                                    <div class="input-normal verifyCode">
                                        <input type="text" autocomplete="off" maxlength="200" name="captcha" value="" placeholder="验证码*">
                                        <span class="verifyImg fr">
                                                <img id="captchaImg" src="<?php echo e(captcha_src()); ?>" style="cursor: pointer" onclick="this.src='<?php echo e(captcha_src()); ?>'+Math.random()" alt="Jebook 验证码">
                                            </span>
                                        <p class="errorMsg">验证码不能为空</p>
                                    </div>
                                </li>
                                <li class="itemForget clearfix">
                                    <div class="input-normal forget clearfix">
                                        <a href="javascript:;">Forgot your password?</a>
                                        <span class="remember  fr">
                                                <span class="fr">Remember me</span>
                                                <input type="checkbox" name="remember" class="fr checkbox" id="checkbox-1" style="display: none;">
                                                 <label for="checkbox-1"></label>
                                            </span>
                                    </div>
                                </li>
                                <li class="itemLogin">
                                    <button class="button-normal" type="button">LOGIN</button>
                                    <p class="errorMsg" style="color: #c01515;font-size: 12px;display: none;position: absolute;"></p>
                                </li>
                                <li class="itemAccount">
                                        <span class="noAccount">
                                            No account? <span><a href="/register.html">Register now</a></span>
                                        </span>

                                </li>
                            </ul>
                        </form>
                        <div class="itemShare">
                            <p>
                                <span>or</span>
                            </p>
                            <div class="share">
                                <a href="javascript:;">
                                    <i class="iconfont icon-Eachine_fb"></i>
                                </a>
                                <a href="javascript:;">
                                    <i class="iconfont icon-Eachine_Google"></i>
                                </a>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo e(URL::asset('/assets/js/jquery.min.js')); ?>"></script>
    <script>
        $(function () {
            $('.button-normal').click(function () {
                $('input[name="email"]').siblings('.errorMsg').hide();
                $('input[name="captcha"]').siblings('.errorMsg').hide();
                $('input[name="password"]').siblings('.errorMsg').hide();
                $('.button-normal').siblings('.errorMsg').hide();
                var captcha = $('input[name="captcha"]').val();
                var email = $('input[name="email"]').val();

                if(!isEmail(email)){
                    $('input[name="email"]').siblings('.errorMsg').show();
                    return;
                }

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
                    data: 'email='+email+'&password='+password+'&captcha='+captcha,
                    url: "/login.html",
                    success: function (res) {
                        //console.log(res.errors.captcha);
                        if(res.code != 200){
                            $('.button-normal').siblings('.errorMsg').html(res.msg).show();
                        }
                        $("#captchaImg").attr('src',"<?php echo e(captcha_src()); ?>" + Math.random());
                        if(res.code == 200){
                            window.location.href = res.data.uri;
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.public.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>