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
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./style.css" />
    <title>注册和登录</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form  action="login_check.php" method="POST" class="sign-in-form" role="form">
            <h2 class="title">登录</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="account" placeholder="用户名" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password"  name="pass" placeholder="密码" />
            </div>
            <input type="submit" value="登 录" class="btn solid" />
            <p class="social-text">或者通过以下平台登录</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-weixin"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-qq"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-alipay"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-github"></i>
              </a>
            </div>
          </form>
          <form action="#" class="sign-up-form">
            <h2 class="title">注册</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="用户名" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="邮箱" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="密码" />
            </div>
            <input type="submit" class="btn" value="注 册" />
            <p class="social-text">或者通过以下平台注册</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-weixin"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-qq"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-alipay"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-github"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <button class="btn transparent" id="sign-up-btn">
              注册
            </button>
          </div>
          <img src="./img/足球1.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <button class="btn transparent" id="sign-in-btn">
              登 录
            </button>
          </div>
          <img src="./img/足球.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
