<?php
session_start();
$user_id = $_SESSION['userId'];
include('../mysqli_connect.php');
$sql = "select userName from user where userId={$user_id}";
$res = mysqli_query($dbc, $sql);
$result = mysqli_fetch_array($res);
$tid = $_GET['id'];

$sqlb = "select * from game where game_id={$tid}";
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
                    <form id="query" class="layui-form-item" action="admin_game_modify.php?id=<?php echo $tid; ?>" method="POST">
                        <div id="query">
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group "><span class="input-group-addon">开始时间</span><input style="width:200px" value="<?php echo $resultb['begin_time']; ?>" name="begin_time" type="text" placeholder="请输入开始时间" class="form-control" maxlength="10"></div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">结束时间</span><input style="width:200px" value="<?php echo $resultb['end_time']; ?>"  name="end_time" type="text" placeholder="请输入结束时间" class="form-control"></div>
                                    </div>
                                </div>
                                <br />
                                <br>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">结束标志</span><input style="width:200px" value="<?php echo $resultb['game_logo']; ?>" pattern="^[1-2]{1}$" name="game_logo" type="text" placeholder="(1:未开始,2:结束)" class="form-control"></div>
                                    </div>
                                </div </div>
                                <br>
                                <br>


                                <div class="input-group"><span class="input-group-addon">比赛描述</span><textarea value="<?php echo $resultb['COMMENT']; ?>" name="COMMENT" type="text" placeholder="300字以内" class="form-control"></textarea></div><br />
                                <button type="button" class="layui-btn layui-btn-danger"><a href="admin_groupgame.php" style="color:white">返回</a></button>
                                <input type="submit" value="确认" class="layui-btn layui-btn-normal">
                                <input type="reset" value="重置" class="layui-btn layui-btn-warm">
                            </div>
                    </form>
                </center>
            </div>
            <?php
            include('../mysqli_connect.php');
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $game_id = $_GET['id'];
                $begin_time = $_POST["begin_time"];
                $end_time = $_POST["end_time"];
                $game_logo = $_POST["game_logo"];
                $COMMENT = $_POST["COMMENT"];

                $sqla = "update game set begin_time='{$begin_time}',end_time='{$end_time}',game_logo=$game_logo,COMMENT='{$COMMENT}' where game_id=$game_id;";
                $resa = mysqli_query($dbc, $sqla);
                if ($resa == 1) {
                    echo "<script>alert('修改成功！')</script>";
                    echo "<script>window.location.href='admin_groupgame.php'</script>";
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