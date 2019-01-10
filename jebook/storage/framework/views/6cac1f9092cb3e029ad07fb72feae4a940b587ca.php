<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jebook - <?php echo $__env->yieldContent('title'); ?></title>
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>">
    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="baidu-site-verification" content="cjtlDzmPCt" />
    <meta name="format-detection" content="telephone=no">
    <meta name="360-site-verification" content="4d3f583be945b12ded8bfeec4db76d7c" />
    <link rel="stylesheet" href="<?php echo e(asset('layui/css/layui.css')); ?>"  media="all">
    <link rel="stylesheet" href="<?php echo e(asset('css/global.css')); ?>"  media="all">
</head>
<body class="site-home" id="LAY_home" data-date="10-9">
<div class="layui-header header header-index" autumn>
    <div class="layui-main">
        <a class="logo" href="/">
            
            <img src="<?php echo e(asset('assets/images/logo1.png')); ?>" alt="Jebook 个人创作平台">
        </a>
        <div class="layui-form component" lay-filter="LAY-site-header-component"></div>
        <ul class="layui-nav">
            <li class="layui-nav-item">
                <a href="/case.html" target="_blank">案例</a>
            </li>
            <li class="layui-nav-item">
                <a href="/news.html" target="_blank">新闻资讯</a>
            </li>
            <li class="layui-nav-item">
                <a href="/about.html" target="_blank">关于我们</a>
            </li>
            <?php if(Session::get('userInfo') != null): ?>
                <li class="layui-nav-item" style="margin: 0px;margin-left: 20px">
                    <a href="/personalCenter.html" target="_blank" style="padding: 0 5px">欢迎回来，<?php echo e(Session::get('userInfo')->nickname); ?></a>
                </li>
                <li class="layui-nav-item" style="margin: 0px">
                    <a href="/logout.html" target="_blank" style="padding: 0 5px">退出</a>
                </li>
            <?php else: ?>
                <li class="layui-nav-item" style="margin: 0px;margin-left: 20px">
                    <a href="/login.html" target="_blank" style="padding: 0 5px">登录</a>
                </li>
                <li class="layui-nav-item" style="margin: 0px">
                    <a href="/register.html" target="_blank" style="padding: 0 5px">注册</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<?php echo $__env->yieldContent('content'); ?>

<div class="layui-footer footer footer-index">
    <div class="layui-main">
        <p>&copy; 2018 <a href="/">jebook.cn</a> MIT license</p>
        <p>
            <a href="/case.html" target="_blank">案例</a>
            
            <a href="/contact.html" site-event="contactInfo">联系我们</a>
            
            
        </p>
        
    </div>
</div>
</body>
</html>

<script>
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
<script>(function(){
        var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?15f087e50403d6a20d9dc2ff3e010b53":"https://jspassport.ssl.qhimg.com/11.0.1.js?15f087e50403d6a20d9dc2ff3e010b53";
        document.write('<script src="' + src + '" id="sozz"><\/script>');
    })();
</script>