@include('admin.public.header')
<div class="x-body">
    {{--<div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
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
    {{--<xblock>--}}
        {{--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','./order-add.html')"><i class="layui-icon"></i>添加</button>
        --}}<span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    {{--</xblock>--}}
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
            <td>{{ $value->method }}</td>
            <td>{{ $value->model }}</td>
            <td>@if($value->data != '[]'){{ $value->data }}@endif</td>
            <td>{{ $value->create_time }}</td>
            <td>{{ $value->User->nickname }}</td>
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
</script>
</body>

</html>