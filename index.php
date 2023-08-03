<!-- <?php
session_start();
if(isset($_SESSION['userId']))
{
    unset($_SESSION['userId']);
}
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/base.css">
  <link rel="stylesheet" href="./lib/bootstrap-5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="./lib/layui-v2.8.12/src/css/layui.css">
  <link rel="stylesheet" href="./css/index.css">

  <title>Document</title>
</head>

<body>
  <!-- 弹出框 -->
  <div class="alert info-box">
  </div>

  <div class="content">
    <div class="panels-container">
      <div class="panel">
        <img src="./img/football.svg" class="image" alt="" />
      </div>
    </div>
    <form class="layui-form" action="login_check.php" method="POST" autocomplete="off">
      <div class="demo-login-container">
        <h2>登录</h2>
        <div class="layui-form-item">
          <div class="layui-input-wrap">
            <div class="layui-input-prefix">
              <i class="layui-icon layui-icon-username"></i>
            </div>
            <input type="text" name="username"  placeholder="用户名" 
              autocomplete="off" class="layui-input" lay-affix="clear">
          </div>
        </div>
        <div class="layui-form-item">
          <div class="layui-input-wrap">
            <div class="layui-input-prefix">
              <i class="layui-icon layui-icon-password"></i>
            </div>
            <input type="password" name="password" value=""  placeholder="密   码"
               autocomplete="off" class="layui-input" lay-affix="eye">
          </div>
        </div>
        <div class="layui-form-item">
          <div class="layui-row">
            <div class="layui-col-xs7">
              <div class="layui-input-wrap">
                <div class="layui-input-prefix">
                  <i class="layui-icon layui-icon-vercode"></i>
                </div>
                <input type="text" name="captcha" value="" lay-verify="required" placeholder="验证码" lay-reqtext="请填写验证码"
                  autocomplete="off" class="layui-input" lay-affix="clear">
              </div>
            </div>
            <div class="layui-col-xs5">
              <div style="margin-left: 10px;">
                <img src="https://www.oschina.net/action/user/captcha"
                  onclick="this.src='https://www.oschina.net/action/user/captcha?t='+ new Date().getTime();">
              </div>
            </div>
          </div>
        </div>
        <div class="layui-form-item">
          <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
          <a href="#" style="float: right; margin-top: 7px;" class="forget">忘记密码？</a>
        </div>
        <div class="layui-form-item">
          <button class="layui-btn layui-btn-fluid layui-btn-radius" lay-submit lay-filter="demo-login">登录</button>
        </div>
        <div class="layui-form-item">
          <button class="layui-btn layui-btn-fluid layui-btn-warm layui-btn-radius" type="reset">重置</button>
        </div>
        <div class="layui-form-item demo-login-other">
          <p>———————&nbsp;&nbsp;&nbsp;&nbsp;其他方式登录&nbsp;&nbsp;&nbsp;&nbsp;———————</p>
          <span style="padding: 0 21px 0 6px;">
            <a href="javascript:;"><i class="layui-icon layui-icon-login-qq" style="color: #3492ed;"></i></a>
            <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat" style="color: #4daf29;"></i></a>
            <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo" style="color: #cf1900;"></i></a>
          </span>
        </div>
      </div>
    </form>
  </div>



  <script src="./lib/layui-v2.8.12/src/layui.js"></script>
  <script src="./js/index.js"></script>
  <script src="./utils/alert.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="./lib/bootstrap-5.3.0/js/bootstrap.min.js"></script>
</body>

</html>