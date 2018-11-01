{include file="public:head"}
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        {include file="public:left_nav"}
        <!--左侧导航结束-->
        
        <!--右侧部分开始-->
        {include file="public:right_head"}
        <!--右侧部分结束-->
    </div>

    <!-- 刷新窗口 -->
    <script>
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
              url:"{:url('Login/up_login')}",
              type:'POST',
              data:'',
              async:false,
              processData:false,
              contentType:false,
              success:function(result) {
                  var index = parent.layer.alert('欢迎在使用!', {
                    ,closeBtn: 0
                  }, function(){
                      window.location.reload();
                  });
              }
          });
        }
    </script>
</body>
</html>
