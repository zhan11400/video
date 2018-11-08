<!DOCTYPE html>  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--360浏览器优先以webkit内核解析-->
    <link rel="shortcut icon" href="favicon.ico">
    
    <script src="{{ URL::asset('admin/js/jquery.min.js?v=2.1.4') }}"></script>
    <link href="{{ URL::asset('admin/css/bootstrap.min.css?v=3.3.6') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/font-awesome.css?v=4.4.0') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/style.css?v=4.1.0') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //统一返回参数
        function ajax_result(message,url){
            var index = parent.layer.alert(message, {
              closeBtn: 0
            }, function(){
              if(typeof(url) == 'undefined'){
                parent.layer.close(index);
              }else{
                location.href = url;
              }
            });
        }

        //返回上一页
        $('.fa-reply', window.parent.document).on('click',function(){
            history.go(-1)
        });

    </script>
</head>