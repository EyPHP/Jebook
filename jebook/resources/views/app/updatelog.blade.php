@extends('app.public.header')

@section('title', '更新日志')
@section('keywords', 'Jebook 更新日志,book,写小说,写博客,jebook')
@section('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷')

@section('content')
<div class="layui-main">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 80px;">
    <legend>Jebook 更新日志</legend>
</fieldset>
<ul class="layui-timeline">
    {{--<li class="layui-timeline-item">
        <i class="layui-icon layui-timeline-axis"></i>
        <div class="layui-timeline-content layui-text">
            <h3 class="layui-timeline-title">8月18日</h3>
            <p>
                layui 2.0 的一切准备工作似乎都已到位。发布之弦，一触即发。
                <br>不枉近百个日日夜夜与之为伴。因小而大，因弱而强。
                <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔 <i class="layui-icon"></i>
            </p>
        </div>
    </li>
    <li class="layui-timeline-item">
        <i class="layui-icon layui-timeline-axis"></i>
        <div class="layui-timeline-content layui-text">
            <h3 class="layui-timeline-title">8月16日</h3>
            <p>杜甫的思想核心是儒家的仁政思想，他有<em>“致君尧舜上，再使风俗淳”</em>的宏伟抱负。个人最爱的名篇有：</p>
            <ul>
                <li>《登高》</li>
                <li>《茅屋为秋风所破歌》</li>
            </ul>
        </div>
    </li>--}}
    <li class="layui-timeline-item">
        <i class="layui-icon layui-timeline-axis"></i>
        <div class="layui-timeline-content layui-text">
            <h3 class="layui-timeline-title">2018年10月12日</h3>
            <p>
                Jebook 正式上线
                <br>不管是作为一个程序员也好，或是以为喜欢写写读读的人也罢，总想有个地方记录自己的生活经历。可是没有技术怎么办？不会搭建自己的博客怎么办？
                <br>Jebook 诞生了，他为所有人提供了一个简单的，独立的，属于自己的写作环境
                <br>我为你自豪
                <br>永垂不朽
            </p>
        </div>
    </li>
    <li class="layui-timeline-item">
        <i class="layui-icon layui-timeline-axis"></i>
        <div class="layui-timeline-content layui-text">
            <div class="layui-timeline-title">过去我来不及参与，未来我奉陪到底</div>
        </div>
    </li>
</ul>
</div>
{{--<script src="{{ asset('layui/dist/layui.js')}}" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
</script>--}}
@endsection
