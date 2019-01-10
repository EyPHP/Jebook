<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jebook About</title>
    <meta name="keywords" content="Jebook About,book,写小说,写博客,jebook">
    <meta name="description" content="Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/normalize.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/demo.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style1.css')); ?>" />
</head>
<style>
    #about{
        width: 400px;
        height: 500px;
        position: absolute;
        z-index: 10;
        top: 200px;
        left: 110px;
        color: #252445;
        font-weight: bold;
        line-height: 25px;
    }

</style>
<body class="demo-1">
<div class="image-preload">
    <img src="<?php echo e(asset('img/drop-color.png')); ?>">
    <img src="<?php echo e(asset('img/drop-alpha.png')); ?>">
    <img src="<?php echo e(asset('img/weather/texture-rain-fg.png')); ?>" />
    <img src="<?php echo e(asset('img/weather/texture-rain-bg.png')); ?>" />
    <img src="<?php echo e(asset('img/weather/texture-sun-fg.png')); ?>" />
    <img src="<?php echo e(asset('img/weather/texture-sun-bg.png')); ?>" />
    <img src="<?php echo e(asset('img/weather/texture-fallout-fg.png')); ?>" />
    <img src="<?php echo e(asset('img/weather/texture-fallout-bg.png')); ?>" />
    <img src="<?php echo e(asset('img/weather/texture-drizzle-fg.png')); ?>" />
    <img src="<?php echo e(asset('img/weather/texture-drizzle-bg.png')); ?>" />
</div>
<div class="container">
    <header class="codrops-header">
        <h1 style="opacity: 0;position: absolute;height: 1px;z-index: -1;">
            Jebook 一个渴望与行动的结果。
            在每一个孤独的夜晚，你们是否想过要写一本书，或者记录一下自己的生活又或者是写写小说？
            在苦思眠想得到一个令人兴奋的结果后，作为程序员的你，是否想过有一个自己的博客记录分享自己的经验？
            当面试官问你是否拥有一个属于自己的博客的时候，你是否后悔过自己没有？
            此时，Jebook 就是为了解决这些问题而来的。
            Jebook 一个简洁快捷的创作平台。不管你是哪行那业的人，只要你敢写你就会写，只要你敢用你就会觉得好用。
            Jebook 只要注册登陆后即可创建自己的博客书籍，并拥有属于自己的专属域名。
        </h1>
        <h1>Jebook &amp; About</h1>
        <nav class="codrops-demos">
            <a class="current-demo" href="/about.html">About</a>
            <a href="/contact.html">Contact us</a>
            <a href="/">Home</a>
        </nav>
    </header>
    <div class="slideshow">
        <div id="about"></div>
        <canvas width="1" height="1" id="container" style="position:absolute"></canvas>
        <!-- Heavy Rain -->
        <div class="slide" id="slide-1" data-weather="rain">
            <div class="slide__element slide__element--date"><?php echo date('l',strtotime($weatherInfo->f1->day)); ?>, <?php echo date('d',strtotime($weatherInfo->f1->day)); ?><sup><?php echo date('S',strtotime($weatherInfo->f1->day)); ?></sup> of <?php echo date('F',strtotime($weatherInfo->f1->day)); ?> <?php echo date('Y',strtotime($weatherInfo->f1->day)); ?></div>
            <div class="slide__element slide__element--temp"><?php echo e($weatherInfo->now->temperature); ?>°<small>C</small></div>
        </div>
        <!-- Drizzle -->
        <div class="slide" id="slide-2" data-weather="drizzle">
            <div class="slide__element slide__element--date"><?php echo date('l',strtotime($weatherInfo->f2->day)); ?>, <?php echo date('d',strtotime($weatherInfo->f2->day)); ?><sup><?php echo date('S',strtotime($weatherInfo->f2->day)); ?></sup> of <?php echo date('F',strtotime($weatherInfo->f2->day)); ?> <?php echo date('Y',strtotime($weatherInfo->f2->day)); ?></div>
            <div class="slide__element slide__element--temp"><?php echo e($weatherInfo->f2->day_air_temperature); ?>°<small>C</small></div>
        </div>
        <!-- Sunny -->
        <div class="slide" id="slide-3" data-weather="sunny">
            <div class="slide__element slide__element--date"><?php echo date('l',strtotime($weatherInfo->f3->day)); ?>, <?php echo date('d',strtotime($weatherInfo->f3->day)); ?><sup><?php echo date('S',strtotime($weatherInfo->f3->day)); ?></sup> of <?php echo date('F',strtotime($weatherInfo->f3->day)); ?> <?php echo date('Y',strtotime($weatherInfo->f3->day)); ?></div>
            <div class="slide__element slide__element--temp"><?php echo e($weatherInfo->f3->day_air_temperature); ?>°<small>C</small></div>
        </div>
        <!-- Heavy rain -->
        <div class="slide" id="slide-5" data-weather="storm">
            <div class="slide__element slide__element--date"><?php echo date('l',strtotime($weatherInfo->f4->day)); ?>, <?php echo date('d',strtotime($weatherInfo->f4->day)); ?><sup><?php echo date('S',strtotime($weatherInfo->f4->day)); ?></sup> of <?php echo date('F',strtotime($weatherInfo->f4->day)); ?> <?php echo date('Y',strtotime($weatherInfo->f4->day)); ?></div>
            <div class="slide__element slide__element--temp"><?php echo e($weatherInfo->f4->day_air_temperature); ?><small>C</small></div>
        </div>
        <!-- Fallout (greenish overlay with slightly greenish/yellowish drops) -->
        <div class="slide" id="slide-4" data-weather="fallout">
            <div class="slide__element slide__element--date"><?php echo date('l',strtotime($weatherInfo->f5->day)); ?>, <?php echo date('d',strtotime($weatherInfo->f5->day)); ?><sup><?php echo date('S',strtotime($weatherInfo->f5->day)); ?></sup> of <?php echo date('F',strtotime($weatherInfo->f1->day)); ?> <?php echo date('Y',strtotime($weatherInfo->f5->day)); ?></div>
            <div class="slide__element slide__element--temp"><?php echo e($weatherInfo->f5->day_air_temperature); ?><small>C</small></div>
        </div>
        <nav class="slideshow__nav">
            <a class="nav-item" href="#slide-1"><img style="width: 32px;height: 32px" src="<?php echo e($weatherInfo->now->weather_pic); ?>"><span><?php echo date('m/d',strtotime($weatherInfo->f1->day)); ?></span></a>
            <a class="nav-item" href="#slide-2"><img style="width: 32px;height: 32px" src="<?php echo e($weatherInfo->f2->day_weather_pic); ?>"><span><?php echo date('m/d',strtotime($weatherInfo->f2->day)); ?></span></a>
            <a class="nav-item" href="#slide-3"><img style="width: 32px;height: 32px" src="<?php echo e($weatherInfo->f3->day_weather_pic); ?>"><span><?php echo date('m/d',strtotime($weatherInfo->f3->day)); ?></span></a>
            <a class="nav-item" href="#slide-5"><img style="width: 32px;height: 32px" src="<?php echo e($weatherInfo->f4->day_weather_pic); ?>"><span><?php echo date('m/d',strtotime($weatherInfo->f4->day)); ?></span></a>
            <a class="nav-item" href="#slide-4"><img style="width: 32px;height: 32px" src="<?php echo e($weatherInfo->f5->day_weather_pic); ?>"></i><span><?php echo date('m/d',strtotime($weatherInfo->f5->day)); ?></span></a>
        </nav>
    </div>
    <p class="nosupport">Sorry, but your browser does not support WebGL!</p>
</div>
<!-- /container -->
<script src="<?php echo e(asset('js/index.min.js')); ?>"></script>
</body>
</html>
<script src="<?php echo e(asset('js/typing.js')); ?>?v=1.1.4"></script>
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
