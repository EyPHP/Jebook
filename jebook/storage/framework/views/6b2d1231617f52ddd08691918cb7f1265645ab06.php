<?php echo $__env->make('admin.public.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="x-body">
    <div class="layui-row">
        
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('审核','/admin/black/add',800,500)"><i class="layui-icon"></i>添加黑名单</button>
        <span class="x-right" style="line-height:40px">共有数据：<?php echo e(count($data)); ?> 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>IP</th>
            <th>操作时间</th>
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
            <td><?php echo e($value->ip); ?></td>
            <td><?php echo e($value->create_time); ?></td>
            <td class="td-manage">
                <a title="删除" href="javascript:;" onclick="member_del(<?php echo e($value->id); ?>)">
                    <i class="layui-icon">&#x1006;</i>
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


    /*用户-删除*/
    function member_del(id){
        layer.confirm('确认要删除吗？',function(index){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                dataType: "json",
                data: 'id='+id,
                url: "/admin/black/del",
                success: function (res) {
                    layer.alert(res.msg, {icon: 6},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                        window.location.reload();
                    });
                }
            });
        });
    }

</script>
</body>

</html>