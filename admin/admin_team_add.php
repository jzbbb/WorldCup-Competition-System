<?php
session_start();
$user_id = $_SESSION['userId'];
include('../mysqli_connect.php');
$sql = "select userName from user where userId={$user_id}";
$res = mysqli_query($dbc, $sql);
$result = mysqli_fetch_array($res);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>世界杯比赛系统</title>
    <link rel="icon" href="./img/足球.png" type="image/x-icon"/>
    <script src="../js/layui.js" charset="UTF-8"></script>
    <script src="../js/time.js"></script>
    <link rel="stylesheet" href="../css/layui.css">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                <li class="layui-nav-item layui-hide-xs"><a href="">添加球队</a></li>
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
                    <form id="query" action="admin_team_add.php?userid=<?php echo $user_id; ?>" method="POST">
                        <div id="query">
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group "><span class="input-group-addon">球队名</span><input required="required" name="teamname" type="text" placeholder="球队名(中文)" class="form-control" maxlength="10"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">世界排名</span><input required="required" pattern="^[0-9]{1,2}$" name="wrank" type="text" placeholder="(数字)" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">小组编号</span><input required="required" pattern="^[A-H]{1}$" name="gno" type="text" placeholder="(A-H)" class="form-control"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">教练</span><input style="width:230px;" name="coachs" type="text" placeholder="输入教练名" class="form-control"></div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">当家球星</span><input style="width:200px;" name="player" type="text" pattern="^[0-9]{1,3}$" placeholder="(数字，默认填0)" class="form-control"></div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">夺冠胜率</span><input style="width:200px;" name="wrate" type="text" pattern="^[1-9]\d*\.\d*|0\.\d*[1-9]\d*$" placeholder="(浮点数,默认填0.1)" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="input-group"><span class="input-group-addon">球队描述</span><textarea value="<?php echo $resultb['teamDesc']; ?>" name="tdesc" placeholder="300字以内" type="text" class="form-control"></textarea></div><br />
                            <button type="button" class="layui-btn layui-btn-danger"><a href="admin_team.php" style="color:white">返回</a></button>
                            <input type="submit" value="确认" class="layui-btn layui-btn-normal">
                            <input type="reset" value="重置" class="layui-btn layui-btn-warm">
                        </div>

                    </form>
                </center>
            </div>
            <?php


            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userid = $_GET['userid'];
                $gjc = $_POST["teamname"];
                $wrank = $_POST["wrank"];
                $gno = $_POST["gno"];
                $coachs = $_POST["coachs"];
                $player = $_POST["player"];
                $wrate = $_POST["wrate"];
                $tdesc = $_POST["tdesc"];

                $sqla = "insert into team(teamName,worldRank,groupNo,coach,bestPlayerId,winRate,teamDesc,createdBy) values('{$gjc}',$wrank,'{$gno}','{$coachs}',$player,$wrate,'{$tdesc}',$userid);";
                $resa = mysqli_query($dbc, $sqla);


                if ($resa == 1) {

                    echo "<script>alert('添加球队成功！')</script>";
                    echo "<script>window.location.href='admin_team.php'</script>";
                } else {
                    echo "<script>alert('添加失败！请重新输入！');</script>";
                }
            }




            ?>


        </div>
    </div>

    <div class="layui-footer">
        <div id="Date" class="text-center layui-icon layui-icon-time"></div>
    </div>
    </div>
</body>

</html>