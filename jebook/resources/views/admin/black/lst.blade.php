@include('admin.public.header')
<div class="x-body">
    <div class="layui-row">
        {{--<form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start">
            <input class="layui-input" placeholder="截止日" name="end" id="end">
            <div class="layui-input-inline">
                <select name="contrller">
                    <option>支付状态</option>
                    <option>已支付</option>
                    <option>未支付</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="contrller">
                    <option>支付方式</option>
                    <option>支付宝</option>
                    <option>微信</option>
                    <option>货到付款</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="contrller">
                    <option value="">订单状态</option>
                    <option value="0">待确认</option>
                    <option value="1">已确认</option>
                    <option value="2">已收货</option>
                    <option value="3">已取消</option>
                    <option value="4">已完成</option>
                    <option value="5">已作废</option>
                </select>
            </div>
            <input type="text" name="username"  placeholder="请输入订单号" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>--}}
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('审核','/admin/black/add',800,500)"><i class="layui-icon"></i>添加黑名单</button>
        <span class="x-right" style="line-height:40px">共有数据：{{count($data)}} 条</span>
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
            {{--<th >操作</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $value)
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{ $value->id }}</td>
            <td>{{ $value->ip }}</td>
            <td>{{ $value->create_time }}</td>
            <td class="td-manage">
                <a title="删除" href="javascript:;" onclick="member_del({{ $value->id }})">
                    <i class="layui-icon">&#x1006;</i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="page">
        <div>
            {{$data->links()}}
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