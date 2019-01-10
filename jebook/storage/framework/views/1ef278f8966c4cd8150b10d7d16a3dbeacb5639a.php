<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <title>新建书籍 - Jebook</title>
    <meta name="keywords" content="新建书籍,book,写小说,写博客,jebook">
    <meta name="description" content="Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('/assets/css/book_create.css')); ?>" />
</head>

<body>
<div class="body">
    <div class="header">
        <a href="/personalCenter.html"><?php echo e($userInfo->nickname); ?></a>
    </div>
    <div class="main">
        <div class="content">
            <span style="font-size: 18px;font-weight: 500;color: #5eb4f3;">创建项目</span>
            <div class="msg">
                <div class="ant-card-body">
                    <span>
                        <span style="font-size: 16px;line-height: 55px">温馨提示：</span>
                    </span>
                    <span>
                        <div>
                            
                            <p>项目创建成功后，审核阶段还不能访问。审核成功后，系统将会通过邮箱把改项目访问网址发送到你邮箱。审核时间为3-5个工作日。</p>
                        </div>
                    </span>
                    <br>
                    
                    <br>
                </div>
            </div>
            <div>
                <form class="form">
                    <div style="width: 70%;margin: auto">
                        <div class="line">
                            <span>中文书名:</span><input required name="book[book_name]" type="text" class="ant-input book_name">
                        </div>
                        <div class="line">
                            <span>英文书名:</span><input required name="book[book_en_name]" type="text" class="ant-input book_en_name">
                        </div>
                        <div class="line">
                            <span>README:</span><textarea required name="book[readme]" class="ant-input readme"></textarea>
                        </div>
                        <div class="line">
                            <span>SUMMARY:</span><textarea required name="book[summary]" class="ant-input summary"></textarea>
                        </div>
                        
                        <div class="line_last">
                            <button type="button" class="ant-btn ant-btn-primary"><span>提交申请</span></button>
                            <button type="button" class="ant-btn btn-a"><a href="/" style="color: currentColor;text-decoration: none;">返回</a></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="<?php echo e(URL::asset('/assets/js/jquery.min.js')); ?>"></script>
<script>
    $(function () {
        $('.ant-btn-primary').click(function () {
            var book_name = $(".book_name").val();
            var book_en_name = $(".book_en_name").val();
            var readme = $(".readme").val();
            var summary = $(".summary").val();
            if(book_name == '' || book_en_name == '' || readme == '' || summary == ''){
                alert('所有数据为必填项.');
                return false;
            }
            if(!checkWord(book_en_name)){
                alert('请核对英文名称是否符合规则.');
                return false;
            }
            save();
        });
    });
    // 请求函数 type 请求类型
    function save() {
        var content = $('.form').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: "json",
            data: content,
            url: "/book/save",
            success: function (res) {
                console.log(res.msg);
                alert(res.msg);
                if(res.code == 200) {
                    window.location.href = '/user/booklist.html';
                }

            }
        });
    }

    function checkWord(nubmer)
    {
        var re =  /^[0-9a-zA-Z]*$/;
        if (!re.test(nubmer)){
            return false;
        }else{
            return true;
        }
    }
</script>