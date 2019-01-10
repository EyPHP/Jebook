<?php echo $__env->make('admin.public.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="x-body">
    <div class="layui-row">
        
    </div>
    
        
        <span class="x-right" style="line-height:40px">共有数据：<?php echo e(count($data)); ?> 条</span>
   
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>项目名称</th>
            <th>项目英文名称</th>
            <th>路径</th>
            <th>域名</th>
            <th>创建人</th>
            <th>创建时间</th>
            <th>修改时间</th>
            <th>审核时间</th>
            <th>状态</th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td><?php echo e($value->id); ?></td>
                <td><a style="color: #1E9FFF" href="/admin/book/info?book_id=<?php echo e($value->id); ?>">
                        <?php echo e(str_limit($value->book_name,36,'...')); ?>

                    </a></td>
                <td><?php echo e($value->book_en_name); ?></td>
                <td><?php echo e($value->path); ?></td>
                <td>http://<?php echo e($value->domain); ?></td>
                <td><?php echo e($value->User->nickname); ?></td>
                <td><?php echo e($value->create_time); ?></td>
                <td><?php echo e($value->update_time); ?></td>
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
                <td class="td-manage">
                    <a title="审核"  onclick="x_admin_show('审核','/admin/book/auditview/<?php echo e($value->id); ?>',800,500)" href="javascript:;">
                        <i class="layui-icon">&#xe63c;</i>
                    </a>
                </td>
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
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

</script>
</body>

</html>