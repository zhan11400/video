<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="nav-close">
    <i class="fa fa-times-circle"></i>
  </div>
  <div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
      <li class="nav-header">
        <div class="dropdown profile-element">
          <span>
            <img alt="image" class="img-circle" src="{$info.head_image}" width="100" height="100"/></span>
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="clear">
              <span class="block m-t-xs">
                <strong class="font-bold"></strong></span>
              <span class="text-muted text-xs block" style="padding-top: 10px;">超级管理员
                <b class="caret"></b></span>
            </span>
          </a>
          <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <!-- <li>
              <a class="J_menuItem" href="form_avatar.html">修改头像</a>
            </li> -->
            <li>
              <a class="J_menuItem" href="{:url('Index/personal_center')}" onclick="close_center()">个人资料</a>
            </li>
<!--             <li>
              <a class="J_menuItem" href="contacts.html">联系我们</a></li>
            <li>
              <a class="J_menuItem" href="mailbox.html">信箱</a></li> -->
            <li class="divider"></li>
            <li>
              <a href="javascript:void(0)" onclick="up_login()">安全退出</a></li>
          </ul>
        </div>
        <div class="logo-element">H+</div>
      </li>
      @foreach($nav as $v)
      <li>
        <a class="J_menuItem" href="{{$v['url']}}" >
          <i class="fa {{$v['left_img']}}"></i>
          <span class="nav-label">{{$v['name']}}</span>
          @if (!empty($v['nav']))
            <span class="fa arrow"></span>
          @endif
        </a>
        @if(!empty($v['nav']))
          <ul class="nav nav-second-level">
            @foreach ($v['nav'] as $vv)
              <li>
                <a class="J_menuItem" href="{{ $vv['url'] }}">{{$vv['name']}}</a>
              </li>
            @endforeach
          </ul>
        @endif
     </li>
    @endforeach
    </ul>
  </div>
</nav>