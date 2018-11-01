<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理 - 登录</title>

    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="{{ URL::asset('admin/css/bootstrap.min.css?v=3.3.6') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/font-awesome.css?v=4.4.0') }}" rel="stylesheet">

    <link href="{{ URL::asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/style.css?v=4.1.0') }}" rel="stylesheet">
    <script src="{{ URL::asset('admin/js/jquery.min.js?v=2.1.4') }}"></script>
    <script src="{{ URL::asset('admin/js/layer/layer.js') }}"></script>

    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen  animated fadeInDown" style="padding-top: 200px">
        <div>
            <h3>欢迎使用</h3>
            <!-- <form class="m-t" role="form" action=""> -->
                <div class="form-group">
                    <input type="text" class="form-control" name="account" placeholder="用户名" >
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="密码" >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="code"  placeholder="验证码" style="float:left;width: 60%">
                    <img class="yzm" src="{{ URL::asset('verify/captcha') }}" style="width:38%;height:34px;padding-left: 2%">
                </div>
                <img src="">
                <button  onclick="ajax_post()" class="btn btn-primary block full-width m-b">登 录</button>
            <!-- </form> -->
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //全局样式
        layer.config({
            skin: 'layui-layer-molv'//自定义样式demo-class
        })

        function ajax_post(){
            var account = $("input[name='account']").val();
            var password = $("input[name='password']").val();
            var code = $("input[name='code']").val();

            $.post("/admin/verify_login",{account:account,passwd:password,code:code},function(result){
                if(typeof(result.errcode) != 'undefined'){
                    var index = layer.alert(result.message, {
                        closeBtn: 0
                    }, function(){
                        layer.close(index);
                    });
                }else{
                    location.href = "/admin/index";
                }
            });

            return false;
        }


        $(".yzm").click(function(){
            if( $(this).attr("src").indexOf('?')>0){
                $(this).attr("src", $(this).attr("src")+'&random='+Math.random());
            }else{
                $(this).attr("src", $(this).attr("src").replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    </script>
</body>
</html>
