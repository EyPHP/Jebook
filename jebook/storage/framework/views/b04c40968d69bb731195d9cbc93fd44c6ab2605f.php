

<?php $__env->startSection('title', '更新日志'); ?>
<?php $__env->startSection('keywords', 'Jebook 更新日志,book,写小说,写博客,jebook'); ?>
<?php $__env->startSection('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷'); ?>

<?php $__env->startSection('content'); ?>
<div class="layui-main">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 80px;">
    <legend>Jebook 更新日志</legend>
</fieldset>
<ul class="layui-timeline">
    
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.public.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>