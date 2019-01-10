@include('admin.public.header')
<body>
<style>
    .layui-input{
        width: 350px;
    }
    .layui-form-label{
        width: 200px;
    }

</style>
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="book_name" class="layui-form-label">
                <span class="x-red"></span>IP
            </label>
            <div class="layui-input-inline">
                <input type="text" id="ip" name="ip" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <label  class="layui-btn" onclick="add()">
                添加
            </label>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

    });
    function add(){

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: "json",
            data: 'ip='+$('#ip').val(),
            url: "/admin/black/add",
            success: function (res) {
                layer.alert(res.msg, {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                    window.parent.location.reload();
                });
            }
        });
    }
</script>
</body>