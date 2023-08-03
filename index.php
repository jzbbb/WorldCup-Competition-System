<?php
session_start();
if(isset($_SESSION['userId']))
{
    unset($_SESSION['userId']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/base.css"> 
  <link rel="stylesheet" href="./lib/bootstrap-5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./font/iconfont1/iconfont.css">

  <title>登录页面</title>
</head>

<body>
  <!-- 弹出框 -->
  <div class="alert info-box">
  </div>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="login_check.php" method="POST" class="sign-in-form" role="form" autocomplete="off">
          <h2 class="title">登录</h2>
          <div class="input-field">
            <i class="iconfont icon-yonghu"></i>
            <input type="text" name="account" placeholder="用户名" />
          </div>
          <div class="input-field">
            <i class="iconfont icon-mima"></i>
            <input type="password" name="pass" placeholder="密码" />
          </div>
          <div class="index-button">
            <input type="submit" value="登 录" class="btn solid" id="login-btn" />
            <input type="reset" value="重 置" class="solid reset" id="reset-btn" />
          </div>

          <p class="social-text">或者通过以下平台登录</p>
          <div class="social-media">
            <a href="#" class="social-icon" id="github">
              <i class="iconfont icon-github"></i>
            </a>
            <a href="#" class="social-icon" id="qq">
              <i class="iconfont icon-QQ"></i>
            </a>
            <a href="#" class="social-icon" id="zhifubao">
              <i class="iconfont icon-zhifubao"></i>
            </a>
            <a href="#" class="social-icon" id="weixin">
              <i class="iconfont icon-weixin"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel">
        <img src="./img/football.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="./js/index.js"></script>
  <script src="./utils/alert.js"></script>
  <script src="./lib/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>

</html>

