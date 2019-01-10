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
            <th>名字</th>
            <th>留言</th>
            <th>回复</th>
            <th>操作时间</th>
            <th>状态</th>
            <th>操作</th>
            
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td><?php echo e($value->id); ?></td>
            <td><?php echo e($value->name); ?></td>
            <td><?php echo e($value->content); ?></td>
            <td><?php echo e($value->reply); ?></td>
            <td><?php echo e($value->create_time); ?></td>
            <td>
                <?php if($value->static == 0): ?>
                    <a href="javascript:;" onclick="contact(<?php echo e($value->id); ?>)">待审核</a>
                <?php else: ?>
                    <a href="javascript:;">通过</a>
                <?php endif; ?>
            </td>
            <td>
                <a title="回复" href="javascript:;" onclick="x_admin_show('审核','/admin/contact/reply?id=<?php echo e($value->id); ?>',800,500)">
                    <i class="layui-icon">&#xe63c;</i>
                </a>
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

    function member_del(id){
        layer.confirm('确认要删除吗？',function(index){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                dataType: "json",
                data: 'id='+id,
                url: "/admin/contact/del",
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

    function contact(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: "json",
            data: 'id='+id,
            url: "/admin/contact/audit",
            success: function (res) {
                layer.alert(res.msg, {icon: 6},function () {
                    window.location.reload();
                });
            }
        });
    }
</script>
</body>

</html>