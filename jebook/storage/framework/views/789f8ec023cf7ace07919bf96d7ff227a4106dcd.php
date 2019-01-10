<?php echo $__env->make('admin.public.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="x-body">
    
    
        <span class="x-right" style="line-height:40px">共有数据：<?php echo e($count); ?> 条</span>
    
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>Ip</th>
            <th>请求方式</th>
            <th>操作路由</th>
            <th style="width: 400px;">数据</th>
            <th>操作时间</th>
            <th>操作人</th>
            
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td><?php echo e($value->id); ?></td>
            <td><?php echo e($value->ip); ?></td>
            <td><?php echo e($value->method); ?></td>
            <td><?php echo e($value->model); ?></td>
            <td><?php if($value->data != '[]'): ?><?php echo e($value->data); ?><?php endif; ?></td>
            <td><?php echo e($value->create_time); ?></td>
            <td><?php echo e($value->User->nickname); ?></td>
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