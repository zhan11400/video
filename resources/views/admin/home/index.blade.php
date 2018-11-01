{include file="public_iframe:head"}
<body class="gray-bg">
  <div class="wrapper wrapper-content">
    <div class="row">
      <div class="col-md-12">
        <div class="ibox-title">
          <div class="box-body">
            <div class="info-box">
              <table class="table table-bordered" style="background:#fff;">
                <tbody>
                  <tr>
                    <td>服务器操作系统：</td>
                    <td>{$sys_info.os}</td>
                    <td>服务器域名/IP：</td>
                    <td>{$sys_info.domain} [ {$sys_info.ip} ]</td>
                    <td>服务器环境：</td>
                    <td>{$sys_info.web_server}</td></tr>
                  <tr>
                    <td>PHP 版本：</td>
                    <td>{$sys_info.phpv}</td>
                    <td>Mysql 版本：</td>
                    <td>{$sys_info.mysql_version}</td>
                    <td>GD 版本</td>
                    <td>{$sys_info.gdinfo}</td></tr>
                  <tr>
                    <td>文件上传限制：</td>
                    <td>{$sys_info.fileupload}</td>
                    <td>最大占用内存：</td>
                    <td>{$sys_info.memory_limit}</td>
                    <td>最大执行时间：</td>
                    <td>{$sys_info.max_ex_time}</td></tr>
                  <tr>
                    <td>安全模式：</td>
                    <td>{$sys_info.safe_mode}</td>
                    <td>Zlib支持：</td>
                    <td>{$sys_info.zlib}</td>
                    <td>Curl支持：</td>
                    <td>{$sys_info.curl}</td></tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>