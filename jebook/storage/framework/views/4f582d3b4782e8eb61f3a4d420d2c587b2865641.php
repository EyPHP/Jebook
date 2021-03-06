

<?php $__env->startSection('title', '个人中心'); ?>
<?php $__env->startSection('keywords', '个人中心,Jebook 登录,book,写小说,写博客,jebook'); ?>
<?php $__env->startSection('description', 'Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/h-admin/css/xadmin.css')); ?>">
<style>
    body{
        background-color: #f0f1f5;
        min-height: auto;
    }
    .header{
        position: fixed !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
    }
    .user p{
        height: 28px;
        line-height: 28px;
    }

    .footer {
        position: relative;
        background-color: #f0f1f5;
    }

</style>
<?php $__env->startSection('content'); ?>

    <div class="layui-container" style="margin-top: 65px;">
        <div style="height: 20px"></div>
        <div class="layui-row">
            <ul style="float: left;padding: 15px 10px;height: 550px" class="layui-nav layui-nav-tree" lay-filter="test">
                <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
                <li class="layui-nav-item">
                    <a href="/personalCenter.html"><span style="padding-right: 5px"><i class="layui-icon">&#xe66f;</i></span></span>个人资料</a>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="/user/booklist.html"><span style="padding-right: 5px"><i class="layui-icon">&#xe705;</i></span>我的书籍</a>
                </li>
                
            </ul>
            <div class="layui-container" style="padding: 34px 20px;border: #ebebeb solid 1px;width: 930px;background-color: #ffffff;float: left;margin-left: 10px">
                <xblock>
                    <button class="layui-btn"><i class="layui-icon"></i><a href="/book/create.html" style="color: #ffffff" target="_blank">新建书籍</a></button>
                    <span class="x-right" style="line-height:40px;float: right">共有数据：<?php echo e($count); ?> 条</span>
                </xblock>
                <div class="layui-col-md12">
                <table class="layui-table">
                    <thead>
                    <tr>
                        <th>
                            <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                        </th>
                        <th>ID</th>
                        <th>项目名称</th>
                        <th>项目英文名称</th>
                        <th>域名</th>
                        <th>创建时间</th>
                        <th>审核时间</th>
                        <th>状态</th>
                        <th>是否公开</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                            </td>
                            <td><?php echo e($value->id); ?></td>
                            <td><a style="color: #1E9FFF" href="/chapter.html?book_id=<?php echo e($value->id); ?>">
                                    <?php echo e(str_limit($value->book_name,36,'...')); ?>

                                </a>
                            </td>
                            <td><?php echo e($value->book_en_name); ?></td>
                            <td>http://<?php echo e($value->domain); ?></td>
                            <td><?php echo e($value->create_time); ?></td>
                            <td>
                                <?php if($value->audit_time != 0): ?>
                                    <?php
                                        echo date('Y-m-d H:i:s',$value->audit_time);
                                    ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($value->status == 0): ?>
                                    <i title="未审核" class="layui-icon" style="cursor:pointer;color: #FFB800;font-size: 24px">&#xe60b;</i>
                                <?php elseif($value->status == 1): ?>
                                    <i title="<?php echo e($value->reason); ?>" class="layui-icon" style="cursor:pointer;color: #1E9FFF;font-size: 24px">&#xe605;</i>
                                <?php else: ?>
                                    <i title="<?php echo e($value->reason); ?>" class="layui-icon" style="cursor:pointer;color: #FF5722;font-size: 24px">&#x1006;</i>
                                <?php endif; ?>
                            </td>
                            <td><?php if($value->public == 1): ?><span style="cursor: pointer;" id="public" onclick="isPublic(<?php echo e($value->id); ?>)">公开</span><?php else: ?><span style="cursor: pointer;" id="public" onclick="isPublic(<?php echo e($value->id); ?>)">不公开</span><?php endif; ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="page">
                    <div>
                        <?php echo e($data->links()); ?>

                    </div>
                </div>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<script src="<?php echo e(URL::asset('/assets/js/jquery.min.js')); ?>"></script>
<script>
    function isPublic(book_id) {
        if(!book_id){
           alert('请先选择书籍');
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            data:"book_id="+book_id,
            dataType: "json",
            url: "/isPublic.html",
            success: function (res) {
                //console.log(res.errors.captcha);
                alert(res.msg);
            }
        });
    }
</script>
<?php echo $__env->make('app.public.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>