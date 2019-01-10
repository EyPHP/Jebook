

<?php $__env->startSection('title', 'Jebook案例'); ?>
<?php $__env->startSection('keywords', 'Jebook案例, 更新日志,book,写小说,写博客,jebook'); ?>
<?php $__env->startSection('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/h-admin/css/xadmin.css')); ?>">
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
</style>
<?php $__env->startSection('content'); ?>
    <div class="layui-container">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>Jebook - 优秀案例</legend>
        </fieldset>
        <div class="layui-row">
            <div id="LAY_demo1" class="layui-col-md12">
                <?php $__currentLoopData = $bookList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="layui-col-md3">
                    <a href="http://<?php echo e($value->domain); ?>" target="_blank">
                    <div class="layui-col-md12 book-img" style="background-color: #1E9FFF">

                    </div>
                    </a>
                    <div class="layui-col-md12 book-info" style="background-color:#f0ad4e">
                        <a href="http://<?php echo e($value->domain); ?>" target="_blank"><span><?php echo e(str_limit($value->book_name,18,'...')); ?></span></a>
                        <span style="float: right">
                        <span>作者：</span><?php echo e(str_limit($value->User->nickname,10,'...')); ?>

                        </span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="page">
                <div>
                    <?php echo e($bookList->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.public.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>