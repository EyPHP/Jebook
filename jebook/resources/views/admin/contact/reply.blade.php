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
            <label for="book_name" class="layui-form-label" style="width: 100px">
                <span class="x-red"></span>回复
            </label>
            <div class="layui-input-inline" style="width: 500px;height: 100px">
                <input type="hidden" id="id" value="{{$id}}">
                <textarea name="reply" id="reply" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <label  class="layui-btn" onclick="add()">
                回复
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

        var reply = $("#reply").val();
        var id = $('#id').val();
        if(!reply || !id){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: "json",
            data: 'id='+id+'&reply='+reply,
            url: "/admin/contact/reply",
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