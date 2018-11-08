@include('admin.public_iframe.head')
  <body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-sm-12">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <h5>
                个人资料
              </h5>
            </div>
            <div class="ibox-content">
              <form method="post" action="" class="form-horizontal" id="brandForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label">头像修改</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control file" style="padding:4px 12px">
                    <img src="{{$info['head_image']}}" width="150" height="150">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">账号</label>
                  <div class="col-sm-10">
                    <input type="text" name="account" class="form-control" value="{{$info['account']}}" disabled>
                  </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">密码</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" value="">
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">确认密码</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="config_password" value="">
                  </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">上一次登录ip</label>

                    <div class="col-sm-10">
                        <input type="text" disabled="" placeholder="{{$info['ip']}}" class="form-control" >
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">上一次登录时间</label>

                    <div class="col-sm-10">
                        <input type="text" disabled="" placeholder="{{$info['logintime']}}" class="form-control" >
                    </div>
                </div>
                <div class="hr-line-dashed"></div>


                <div class="form-group">
                  <div class="col-sm-4 col-sm-offset-2">
                  <a class="btn btn-primary" onclick="submit();">保存</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
        function submit(){
            var formData = new FormData();    
            var account = $("input[name='account']").val();
            var password = $("input[name='password']").val();
            var config_password = $("input[name='config_password']").val();

            if(password != config_password){
                var index = parent.layer.alert('密码不一致', {
                  skin: 'layui-layer-molv' //样式类名
                  ,closeBtn: 0
                }, function(){
                    parent.layer.close(index);
                });
                return false;
            }

            var file = $(".file").get(0).files[0];
            formData.append('account',account);
            formData.append('passwd',password);
            formData.append('image',file);


            $.ajax({
              url:'/index/personal_center',
              type:'POST',
              data:formData,
              async:false,
              processData:false,
              contentType:false,
              success:function(result) {
                  if(typeof(result.errcode) != 'undefined'){
                      ajax_result(result.message);
                  }else{
                      ajax_result('修改成功','/index/personal_center');
                  }
              }
            });
        }
    </script>
</body>
</html>