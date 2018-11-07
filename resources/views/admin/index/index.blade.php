@include('admin.public.head')
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        @include('admin.public.left_nav')
        <!--左侧导航结束-->
        
        <!--右侧部分开始-->
        @include('admin.public.right_head')
        <!--右侧部分结束-->
    </div>    

    <!-- 全局js -->
    <script src="{{ URL::asset('admin/js/jquery.min.js?v=2.1.4') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap.min.js?v=3.3.6') }}"></script>
    <script src="{{ URL::asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ URL::asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/plugins/layer/layer.min.js') }}"></script>
    
    <script src="{{ URL::asset('admin/js/hplus.js?v=4.1.0') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/js/contabs.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- 刷新窗口 -->
    <script>
        //全局样式
        layer.config({
            skin: 'layui-layer-molv'//自定义样式demo-class
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //刷新iframe
        function reload(){
            var i = 0;
            $('.J_menuTabs').find('.page-tabs-content a').each(function(){
                if($(this).hasClass('active')){
                  return false;
                }else{
                  i++;
                }
            });
            $('.J_iframe').eq(i).attr('src', $('.J_iframe').eq(i).attr('src'));
        }

        //关闭个人中心
        function close_center(){
            //关闭窗口
            $('.profile-element').removeClass('open');
        }

        function up_login(){
            $.ajax({
              url:"/admin/up_login",
              type:'POST',
              data:'',
              async:false,
              processData:false,
              contentType:false,
              success:function(result) {
                  var index = parent.layer.alert('欢迎在使用!', {
                    closeBtn: 0
                  }, function(){
                      window.location.reload();
                  });
              }
          });
        }
    </script>
</body>
</html>
