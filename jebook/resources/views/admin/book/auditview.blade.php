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
                <span class="x-red"></span>项目名称
            </label>
            <div class="layui-input-inline">
                <input type="text" readonly disabled id="book_name" name="book_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$bookModel->book_name}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="book_en_name" class="layui-form-label">
                <span class="x-red"></span>项目英文名称
            </label>
            <div class="layui-input-inline">
                <input type="text" readonly disabled id="book_en_name" name="book_en_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$bookModel->book_en_name}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red"></span>创建人
            </label>
            <div class="layui-input-inline">
                <input type="text" readonly disabled id="username" name="username" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $bookModel->User->nickname }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="path" class="layui-form-label">
                <span class="x-red"></span>路径
            </label>
            <div class="layui-input-inline">
                <input type="text" id="path" readonly disabled name="path" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$bookModel->path}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="domain" class="layui-form-label">
                <span class="x-red">*</span>域名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="domain" name="domain" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$bookModel->domain}}">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>通过/不通过原因
            </label>
            <div class="layui-input-block">
                <textarea style="width: 350px" placeholder="请输入内容" id="desc" name="desc" class="layui-textarea">@if ($bookModel->reason == '' && $bookModel->status == 0)
符合标准，审核通过@else{{$bookModel->reason}}@endif</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>

            <label  class="layui-btn" onclick="audit('{{ $bookModel->id }}',1)">
                通过
            </label>
            <label  class="layui-btn" onclick="audit('{{ $bookModel->id }}',2)"  style="background-color: #ff9800" lay-submit="">
                不通过
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
    function audit(id,status){
        var domain = $('#domain').val();
        var desc = $('#desc').val();
        if(!domain || !desc || !id || !status){
            layer.alert("操作失败");
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: "json",
            data: 'id='+id+'&domain='+domain+'&desc='+desc+'&status='+status,
            url: "/admin/book/audit",
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