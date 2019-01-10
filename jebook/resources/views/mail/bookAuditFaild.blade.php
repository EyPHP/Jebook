<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <style>
        a,address,article,aside,b,body,center,dd,del,div,dl,dt,em,embed,fieldset,footer,form,h1,h2,h3,h4,h5,h6,header,html,i,iframe,img,label,legend,li,nav,object,ol,output,p,section,span,table,tbody,td,tfoot,th,thead,tr,tt,ul{word-wrap:break-word}body,dd,dl,dt,fieldset,form,h1,h2,h3,h4,h5,h6,html,img,legend,li,ol,p,ul{margin:0;padding:0;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}button,fieldset,img,input{border:none;padding:0;margin:0;outline-style:none}ol,ul{list-style:none}input{padding-top:0;padding-bottom:0;white-space:nowrap;font-family:arial}input,select{vertical-align:middle}input,select,textarea{font-size:12px;margin:0}textarea{resize:none}img{border:0;vertical-align:middle}table{border-collapse:collapse}body{font:14px/150% arial;background:#fff}.clearfix:after,.clearfix:before{height:0;content:"";display:block;clear:both;visibility:hidden}.clearfix{*zoom:1}a{color:#000;text-decoration:none}h1,h2,h3,h4,h5,h6{text-decoration:none;font-weight:400;font-size:100%}em,i,s{font-style:normal;text-decoration:none}.col-red{color:#d53333!important}.w{margin:0 auto}.fl{float:left}.fr{float:right}.al{text-align:left}.ac{text-align:center}.ar{text-align:right}.hide{display:none}.pr{position:relative}iframe{display:block;border:0}*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}:-moz-placeholder{color:#999;opacity:1}::-moz-placeholder{color:#999;opacity:1}input:-ms-input-placeholder,textarea:-ms-input-placeholder{color:#999;opacity:1}input::-webkit-input-placeholder,textarea::-webkit-input-placeholder{color:#999;opacity:1}html{-webkit-tap-highlight-color:transparent}article,aside,details,figcaption,figure,footer,header,menu,nav{display:block;width:100%}.wrap{margin:0 auto}@media (min-width:992px){.wrap{width:970px}}@media (min-width:1200px){.wrap{width:1200px}}@media (min-width:1600px){.wrap{width:1500px}}@media (max-width:768px){.wrap{width:100%}}
        /*Email Style*/
        .emailBox{width:100%}.emailBox .email{width:90%;max-width:606px;margin:0 auto}.emailBox .email .content{padding-bottom:38px;border-bottom:1px solid #e6e6e6}.emailBox .email .emailLogo{display:block;margin:40px 0 42px;max-width: 160px;height: auto}.emailLogo img{width: 100%;height:auto}.emailBox .email h3{font-size:28px;font-weight:700;margin-bottom:40px}.emailBox .email p{margin-bottom:30px;font-size:16px;color:#666}.emailBox .email p a{color:#000;font-weight:700}.emailBox .email p span{font-weight:700}.emailBox .email p.last{margin-bottom:0}.emailBox .email p.emailCopy{margin-top:18px;font-size:14px}@media screen and (min-width:769px){.emailBox p a:hover{text-decoration:underline}}
    </style>
</head>
<body>
<div class="emailBox">
    <div class="email">
        <a class="emailLogo" href="javascirpt:;"><img src="{{--{$logo}--}}"></a>
        <p>尊敬的{{$username}}，您好！</p>
        <div class="content">
            <p>你的项目 {{$name}} 激活失败, 原因如下： </p>
            <p><a href="javasrcipt:;">{{$reason}}</a></p>
            <p>请通过<a href="http://www.jebook.cn/personalCenter.html">个人中心</a>根据提示修改后重新提交。感谢您的信任。</p>
            <br>
            <br>
            <p class="last">本邮件由系统自动发出，请勿直接回复！</p>
        </div>
        <p class="emailCopy">Copyright© @php echo date('Y',time()); @endphp Jebook  All rights reserved</p>
    </div>
</div>
</body>
</html>