<?php echo $__env->make('admin.public.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="x-body">
    <div class="layui-row">
        
    </div>
    
        <span class="x-right" style="line-height:40px">共有数据：<?php echo e($count); ?> 条</span>
    
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>用户邮箱</th>
            <th>用户名</th>
            <th>英文名称</th>
            <th>性别</th>
            <th>职业</th>
            <th>用户积分</th>
            <th>用户等级</th>
            <th>邮箱是否验证</th>
            <th>状态</th>
            <th>注册时间</th>
            
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td><?php echo e($value->id); ?></td>
            <td><?php echo e($value->email); ?></td>
            <td><?php echo e($value->nickname); ?></td>
            <td><?php echo e($value->username); ?></td>
            <td><?php echo e($value->sex); ?></td>
            <td><?php echo e($value->occupation); ?></td>
            <td><?php echo e($value->integral); ?></td>
            <td><?php echo e($value->level); ?></td>
            <td>
                <?php if($value->verify == 0): ?>
                    <i title="未验证" class="layui-icon" style="cursor:pointer;color: #FFB800;font-size: 24px">&#xe60b;</i>
                <?php else: ?>
                    <i title="已验证" class="layui-icon" style="cursor:pointer;color: #46a74a;font-size: 24px">&#x1005;</i>
                <?php endif; ?>
            </td>
            <td>
                <?php if($value->status == 0): ?>
                    <i title="不可用" onclick="setUserStatus('<?php echo e($value->id); ?>',0)" class="layui-icon" style="cursor:pointer;color: #FF5722;font-size: 24px">&#x1006;</i>
                <?php else: ?>
                    <i title="可用" onclick="setUserStatus('<?php echo e($value->id); ?>',1)" class="layui-icon" style="cursor:pointer;color: #46a74a;font-size: 24px">&#x1005;</i>
                <?php endif; ?>
            </td>
            <td><?php echo e($value->create_time); ?></td>
            
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
    function setUserStatus(id,status){
        if(!id || status === ''){
            layer.alert("操作失败");
            return false;
        }
        if(status == 1){
            status = 0;
        }else{
            status = 1;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: "json",
            data: 'id='+id+'&status='+status,
            url: "/admin/user/setUserStatus",
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
    }
</script>
</body>

</html>