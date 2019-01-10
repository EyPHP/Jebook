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
        </form>--}}
    </div>
    {{--<xblock>--}}
        {{--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','')"><i class="layui-icon"></i>添加</button>
--}}
        <span class="x-right" style="line-height:40px">共有数据：{{count($data)}} 条</span>
   {{-- </xblock>--}}
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
        @foreach ($data as $value)
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>{{ $value->id }}</td>
                <td><a style="color: #1E9FFF" href="/admin/book/info?book_id={{$value->id}}">
                        {{str_limit($value->book_name,36,'...')}}
                    </a></td>
                <td>{{ $value->book_en_name }}</td>
                <td>{{ $value->path }}</td>
                <td>http://{{ $value->domain }}</td>
                <td>{{ $value->User->nickname }}</td>
                <td>{{ $value->create_time }}</td>
                <td>{{ $value->update_time }}</td>
                <td>
                    @if ($value->audit_time != 0)
                        @php
                            echo date('Y-m-d H:i:s',$value->audit_time);
                        @endphp
                    @endif
                </td>
                <td>
                    @if ($value->status == 0)
                        <i title="未审核" class="layui-icon" style="cursor:pointer;color: #FFB800;font-size: 24px">&#xe60b;</i>
                    @elseif ($value->status == 1)
                        <i title="{{ $value->reason }}" class="layui-icon" style="cursor:pointer;color: #1E9FFF;font-size: 24px">&#xe605;</i>
                    @else
                        <i title="{{ $value->reason }}" class="layui-icon" style="cursor:pointer;color: #FF5722;font-size: 24px">&#x1006;</i>
                    @endif
                </td>
                <td class="td-manage">
                    <a title="审核"  onclick="x_admin_show('审核','/admin/book/auditview/{{ $value->id }}',800,500)" href="javascript:;">
                        <i class="layui-icon">&#xe63c;</i>
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

</script>
</body>

</html>