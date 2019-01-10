<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8" />
        <title>新建章节 - {{$bookModel->book_name or 'Jebook'}}</title>
        <meta name="keywords" content="{{$bookModel->book_name or 'Jebook'}},book,写小说,写博客,jebook">
        <meta name="description" content="Jebook 一个非常适合个人写博客，小编写书的平台，随时创建随时写作，方便快捷">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ URL::asset('/assets/css/style.css')}}" />
        <link rel="stylesheet" href="{{ URL::asset('/assets/css/editormd.css')}}" />
        <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="{{ URL::asset('/assets/css/book_create.css')}}" />
    </head>
    <style>
        header{
            height: 70px;
        }
        header div{
            float: left;
        }
        header div:nth-child(1){
            width: 70%;
        }
        header div:nth-child(2){
            width: 30%;
            text-align: right;
        }
        header div:nth-child(2) span{
            cursor: pointer;
        }
        header div:nth-child(2) span:nth-child(1){
            margin: 0px 20px;
        }
        .clear{
            clear: both;
        }

        .line span{
            height: 28px;
            line-height: 25px;
            text-align: left;
        }
        .ant-input{
            margin-left: 0px !important;
        }
        .select{
            position: absolute;
            width: 25%;
            height: 200px;
            left: 16%;
            z-index: 100;
            border-radius: 3px;
            box-sizing: border-box;
            border: 1px solid #e5e5e5;
            background-color: #FFFFFF;
            display: none;
            overflow-y: auto;
        }
        .select span{
            display: block;
            width: 100%;
            padding: 1px 15px;
            cursor: pointer;
        }
        .select span:hover{
            display: block;
            width: 100%;
            padding: 1px 15px;
            cursor: pointer;
            background-color: #f6f6f6;
        }
    </style>
    <body>
        <div id="layout">
            <header>
                <div>
                    <h1 style="font-size: 18px">所编辑书籍：{{$bookModel->book_name or 'Demo'}}</h1>
                </div>
                <div>
                    <span style="padding-left: 10px"><a style="color: #666;font-size: 16px" href="/chapter.html?book_id={{$bookModel->id}}">返回</a></span>
                    <span style="padding-left: 10px;font-size: 16px" id="save">保存草稿</span>
                    <span style="padding-left: 10px;font-size: 16px" id="release">发布</span>
                </div>
                <div class="clear"></div>
            </header>
            <div style="margin-bottom: 10px">
                <form class="form">
                    <div style="width:90%;margin: auto">
                        <div class="line">
                            <span>文章标题:</span><input style="width: 20%" required name="title" type="text" class="ant-input title" value="{{$articleModel->title or ''}}">
                        </div>
                        <div class="line">
                            <span>文章路径:</span>
                            <div style="position: relative;">
                            <input @php if(isset($articleModel) && $articleModel->type == 1){ echo 'readonly disabled';} @endphp value="{{$articleModel->path  or ''}}" style="width: 25%;margin-bottom: 1px;" required name="path" id="path" type="text" class="event ant-input path">
                            <div class="select event">

                                @foreach ($chapter as $val)
                                    @if($val->path != '')
                                    <span vlaue="{{$val->path}}">{{$val->path}}</span>
                                    @endif
                                @endforeach

                            </div>
                            </div>
                        </div>
                        <div class="line">
                            <span>文章关键字（SEO优化使用）:</span><input value="{{$articleModel->keywords  or ''}}" required name="keywords" type="text" class="ant-input keywords">
                        </div>
                        <div class="line">
                            <span>文章描述（SEO优化使用）:</span><input value="{{$articleModel->desc  or ''}}" required name="desc" type="text" class="ant-input desc">
                        </div>

                        {{--<div class="line">
                            <span>README:</span><textarea required name="book[readme]" class="ant-input readme"></textarea>
                        </div>
                        <div class="line">
                            <span>SUMMARY:</span><textarea required name="book[summary]" class="ant-input summary"></textarea>
                        </div>--}}
                        {{--<div class="line">
                            <span>总监/总负责人:</span><input type="text" class="ant-input">
                        </div>--}}
                        {{--<div class="line_last">
                            <button type="button" class="ant-btn ant-btn-primary"><span>提交申请</span></button>
                            <button type="button" class="ant-btn btn-a"><a href="/" style="color: currentColor;text-decoration: none;">返回</a></button>
                        </div>--}}
                    </div>

                </form>
            </div>
            <div id="test-editormd">
                <input id="article_id" value="{{$articleModel->id  or ''}}" type="hidden">
                <input id="book_id" value="{{$book_id}}" type="hidden">
                <textarea id="text" style="display:none;">{{$articleModel->content  or ''}}</textarea>
            </div>
        </div>
        <script src="{{ URL::asset('/assets/js/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('/assets/js/editormd.min.js')}}"></script>
        <script type="text/javascript">
			var testEditor;
            $(function() {
                testEditor = editormd("test-editormd", {
                    width   : "90%",
                    height  : 640,
                    syncScrolling : "single",
                    path    : "{{ URL::asset('/assets/lib') }}/"
                });
            });
        </script>
        <script>
            $(function () {
                // 手动保存草稿
                $('#save').click(function () {
                    save('save')
                });

                // 每隔20秒自动保存一次草稿，失败忽略
                var timer = setInterval(function() {
                    save('timer');
                }, 20000);
                setTimeout(timer,20000)

                // 发布
                $('#release').click(function (e) {
                    save('release');
                });

                $('#path').focus(function () {
                    $('.select').show();
                });

                /*$('#path').blur(function () {

                    $("#path").val($(this).val());
                    $('.select').hide();
                });*/
                $('.select span').click(function () {
                    $("#path").val($(this).attr('vlaue'));
                    $('.select').hide();
                });

                $(document).click(function(event){
                    var _con = $('.event');   // 设置目标区域
                    if(!_con.is(event.target) && _con.has(event.target).length === 0){
                        $('.select').hide();
                    }
                });

            });

            // 请求函数 type 请求类型
            function save(type) {
                var content = '';
                var text = $('#text').html();
                var book_id = $('#book_id').val();

                var id = $('#article_id').val();

                var path = $('.path').val();
                var keywords = $('.keywords').val();
                var desc = $('.desc').val();
                var title = $('.title').val();
                // type == 1 表示已经发布 否则为未发布

                if(text == ''){
                    return;
                }

                if(book_id == ''){
                    return;
                }

                if(type == 'release'){
                    content = 'text='+text+'&type=1';
                }else{
                    content = 'text='+text;
                }

                if(id){
                    content += '&id='+id;
                }
                content += '&title='+title+'&book_id=' + book_id + '&path='+path+'&keywords='+keywords+'&desc='+desc;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: "json",
                    data: content,
                    url: "/article/save",
                    beforeSend: function(){
                        $("#path").attr("readonly",true);
                        $("#path").attr("disabled","disabled");
                    },
                    success: function (res) {
                        if(res.code == 200) {
                            $("#article_id").val(res.data.id);
                        }

                        $("#path").attr("readonly",false);
                        $("#path").removeAttr("disabled");

                        if(res.code == 200 && type == 'release'){
                            window.location.href = '/chapter.html?book_id='+book_id;
                        }
                    }
                });
            }
        </script>
    </body>
</html>