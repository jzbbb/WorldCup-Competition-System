<?php
session_start();
$user_id = $_SESSION['userId'];
include('../mysqli_connect.php');
$sql = "select userName from user where userId={$user_id}";
$res = mysqli_query($dbc, $sql);
$result = mysqli_fetch_array($res);
$tid = $_GET['id'];

$sqlb = "select * from player where player_id={$tid}";
$resb = mysqli_query($dbc, $sqlb);
$resultb = mysqli_fetch_array($resb);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>世界杯比赛系统</title>
    <link rel="icon" href="./img/足球.png" type="image/x-icon"/>
    <script src="../js/layui.js" charset="UTF-8"></script>
    <script src="../js/time.js"></script>
    <script src="../js/laydate.js"></script>
    <link rel="stylesheet" href="../css/layui.css">

    <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdn.bootcss.com/moment.js/2.22.0/moment-with-locales.js"></script>
</head>

<body>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <div class="layui-logo layui-hide-xs layui-bg-black"><img src="../img/世界杯.png" style="height: 60px; width: 60px;"></div>
            <!-- 头部区域（可配合layui 已有的水平导航） -->
            <ul class="layui-nav layui-layout-left">
                <!-- 移动端显示 -->
                <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-header-event="menuLeft">
                    <i class="layui-icon layui-icon-spread-left"></i>
                </li>

                <li class="layui-nav-item layui-hide-xs"><a href="">当前页面：</a></li>
                <li class="layui-nav-item layui-hide-xs"><a href="">球员修改</a></li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item layui-hide layui-show-md-inline-block">
                    <a href="javascript:;">
                        <img src="../img/头像.png" class="layui-nav-img">
                        <?php echo $result['userName'];  ?>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">个人信息</a></dd>
                        <dd><a href="javascript:;">修改信息</a></dd>
                        <dd><a href="javascript:;">修改密码</a></dd>
                        <dd><a href="../index.php">退出</a></dd>
                    </dl>
                </li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black">
            <ul class="layui-nav layui-nav-tree" lay-filter="test">
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="admin_index.php">首页</a>
                </li>
                <li class="layui-nav-item">
                    <a href="#">比赛管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="admin_groupgame.php">小组赛</a></dd>
                        <dd><a href="#">淘汰赛</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="#">球队管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="admin_team.php">球队表</a></dd>
                        <dd><a href="admin_team_win.php">夺冠概率</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="#">球员管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="admin_player.php">球员表</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="#">用户管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="admin_user.php">用户表</a></dd>
                        <dd><a href="admin_user_distribute.php">用户分布</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed"><a href="../index.php">退出系统</a></li>
            </ul>
        </div>

        <div class="layui-body">
            <div style="padding: 50px 100px 15px;">
                <center>
                    <form id="query" class="layui-form-item" action="admin_player_modify.php?id=<?php echo $tid; ?>" method="POST">
                        <div id="query">
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group "><span class="input-group-addon">球员名</span><input value="<?php echo $resultb['player_name']; ?>" name="player_name" type="text" placeholder="请输入名字" class="form-control" maxlength="10"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">号码</span><input value="<?php echo $resultb['player_num']; ?>" pattern="^[0-9]{1,2}$" name="player_num" type="text" placeholder="请输入号码" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">年龄</span><input value="<?php echo $resultb['player_age']; ?>" pattern="^[0-9]{1,2}$" name="player_age" type="text" placeholder="请输入年龄" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">身高</span><input value="<?php echo $resultb['height']; ?>" pattern="^[0-9]{3}$" name="height" type="text" placeholder="请输入身高" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">俱乐部</span><input value="<?php echo $resultb['player_club']; ?>" name="player_club" type="text" placeholder="请输入俱乐部" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">年薪</span><input value="<?php echo $resultb['player_salary']; ?>" name="player_salary" type="text" placeholder="请输入年薪" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">位置</span><input value="<?php echo $resultb['player_pos']; ?>" name="player_pos" type="text" placeholder="请输入位置" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">生日</span><input  value="<?php echo $resultb['birth_date']; ?>" name="birth_date" type="text" placeholder="请输入生日" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="input-group"><span class="input-group-addon">球员描述</span><textarea value="<?php echo $resultb['player_desc']; ?>" name="player_desc" type="text" placeholder="300字以内" class="form-control"></textarea></div><br />
                            <button type="button" class="layui-btn layui-btn-danger"><a href="admin_player.php" style="color:white">返回</a></button>
                            <input type="submit" value="确认" class="layui-btn layui-btn-normal">
                            <input type="reset" value="重置" class="layui-btn layui-btn-warm">
                        </div>
                    </form>
                </center>
            </div>
            <?php
            include('../mysqli_connect.php');
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $player_id = $_GET['id'];
                $player_name = $_POST["player_name"];
                $player_num = $_POST["player_num"];
                $player_age = $_POST["player_age"];
                $height = $_POST["height"];
                $player_club = $_POST["player_club"];
                $player_salary = $_POST["player_salary"];
                $player_pos = $_POST["player_pos"];
                $birth_date = $_POST["birth_date"];
                $player_desc = $_POST["player_desc"];

                $sqla = "update player set player_desc='{$player_desc}',player_name='{$player_name}',player_num=$player_num,player_age=$player_age,height=$height,player_club='{$player_club}',player_salary=$player_salary,player_pos='{$player_pos}',birth_date='{$birth_date}' where player_id=$player_id;";
                $resa = mysqli_query($dbc, $sqla);
                if ($resa == 1) {
                    echo "<script>alert('修改成功！')</script>";
                    echo "<script>window.location.href='admin_player.php'</script>";
                } else {
                    echo "<script>alert('修改失败！请重新输入！');</script>";
                }
            }
            ?>


        </div>

        <div class="layui-footer">
            <div id="Date" class="text-center layui-icon layui-icon-time"></div>
        </div>
    </div>
</body>

</html>