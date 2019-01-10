@include('admin.public.header')
<style>
    .layui-colla-content{
        padding: 10px 35px;
    }
</style>
<div class="x-body">
    <xblock>
        <button class="layui-btn"><a style="color: #fff" href="/admin/book/list">返回书籍</a></button>
    </xblock>
    <fieldset class="layui-elem-field layui-field-title">
        <legend>书籍：{{$book_name}} <span style="font-size: 12px">共有数据：{{$count}} 条</span></legend>
    </fieldset>
    <div class="layui-collapse" lay-accordion="">
        @foreach ($data as $k1 => $val1)
        <div class="layui-colla-item">
            @if($k1 != 'null')
            <h2 class="layui-colla-title">{{$k1}}</h2>
            @foreach ($val1['data'] as $dk1 => $dv1)
            <div class="layui-colla-content">
                <a target="_blank" style="color: #1E9FFF" href="/">{{$dv1->title}}</a>
            </div>
            @endforeach
            @if(!empty($val1['sub']))
                <div class="layui-colla-content">
                    <div class="layui-collapse" lay-accordion="">
                        @foreach ($val1['sub'] as $k2 => $val2)
                        <div class="layui-colla-item">
                            <h2 class="layui-colla-title">{{$k2}}</h2>
                            @foreach ($val2['data'] as $dk2 => $dv2)
                                <div class="layui-colla-content">
                                    <a target="_blank" style="color: #1E9FFF" href="/">{{$dv2->title}}</a>
                                </div>
                            @endforeach
                            @if(!empty($val2['sub']))
                            <div class="layui-colla-content">

                                <div class="layui-collapse" lay-accordion="">
                                    @foreach ($val2['sub'] as $k3 => $val3)
                                    <div class="layui-colla-item">
                                        <h2 class="layui-colla-title">{{$k3}}</h2>
                                        @foreach ($val3['data'] as $dk3 => $dv3)
                                            <div class="layui-colla-content">
                                                <a target="_blank" style="color: #1E9FFF" href="/">{{$dv3->title}}</a>
                                            </div>
                                        @endforeach
                                        @if(!empty($val3['sub']))
                                        <div class="layui-colla-content">
                                            <div class="layui-collapse" lay-accordion="">
                                                @foreach ($val3['sub'] as $k4 => $val4)
                                                <div class="layui-colla-item">
                                                    <h2 class="layui-colla-title">{{$k4}}</h2>
                                                    @foreach ($val4['data'] as $dk4 => $dv4)
                                                        <div class="layui-colla-content">
                                                            <a target="_blank" style="color: #1E9FFF" href="/">{{$dv4->title}}</a>
                                                        </div>
                                                    @endforeach
                                                    @if(!empty($val4['sub']))
                                                    <div class="layui-colla-content">
                                                        <div class="layui-collapse" lay-accordion="">
                                                            @foreach ($val4['sub'] as $k5 => $val5)
                                                            <div class="layui-colla-item">
                                                                <h2 class="layui-colla-title">{{$k5}}</h2>
                                                                @foreach ($val5['data'] as $dk5 => $dv5)
                                                                    <div class="layui-colla-content">
                                                                        <a target="_blank" style="color: #1E9FFF" href="/">{{$dv5->title}}</a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                </div>
            @endif
            @else
                @foreach ($val1['data'] as $dk1 => $dv1)
                    <div class="layui-colla-content" style="display: block;padding: 10px 17px;">
                        <a target="_blank" style="color: #1E9FFF" href="/">{{$dv1->title}}</a>
                    </div>
                @endforeach
            @endif
        </div>
        @endforeach
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

    /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

            }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
            }

        });
    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }

    function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
</body>

</html>