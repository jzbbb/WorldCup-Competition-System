<?php
session_start();
$user_id = $_SESSION['userId'];
include('../mysqli_connect.php');
$sql = "select userName from user where userId={$user_id}";
$res = mysqli_query($dbc, $sql);
$result = mysqli_fetch_array($res);
$tid = $_GET['id'];

$sqlb = "select teamName,worldRank,groupNo,groupPoint,groupRank,wins,draws,fails,goals,
coach,winRate,teamDesc from team where teamId={$tid}";
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
                <li class="layui-nav-item layui-hide-xs"><a href="">球队修改</a></li>
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
                    <form id="query" action="admin_team_modify.php?id=<?php echo $tid; ?>" method="POST">
                        <div id="query">
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group "><span class="input-group-addon">球队名</span><input value="<?php echo $resultb['teamName']; ?>" name="tname" type="text" placeholder="请输入球队名" class="form-control" maxlength="10"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">世界排名</span><input value="<?php echo $resultb['worldRank']; ?>" pattern="^[0-9]{1,2}$" name="wrank" type="text" placeholder="请输入世界排名" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">胜</span><input value="<?php echo $resultb['wins']; ?>" pattern="^[0-3]{1}$" name="win" type="text" placeholder="请输入胜局数" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">平</span><input value="<?php echo $resultb['draws']; ?>" pattern="^[0-3]{1}$" name="draw" type="text" placeholder="请输入平局数" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">败</span><input value="<?php echo $resultb['fails']; ?>" pattern="^[0-3]{1}$" name="fail" type="text" placeholder="请输入负局数" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">进球数</span><input value="<?php echo $resultb['goals']; ?>" name="goal" pattern="^[0-9]{1,2}$" type="text" placeholder="请输入进球数" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">教练</span><input value="<?php echo $resultb['coach']; ?>" name="coachs" type="text" placeholder="请输入教练名" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">夺冠胜率</span><input value="<?php echo $resultb['winRate']; ?>" pattern="^[1-9]\d*\.\d*|0\.\d*[1-9]\d*$" name="wrate" type="text" placeholder="请输入夺冠胜率" class="form-control"></div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <div class="input-group"><span class="input-group-addon">当家球星</span><input style="width: 200px;" pattern="^[0-9]{1,2}$" name="player_id" type="text" placeholder="请输入球员编号" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="input-group"><span class="input-group-addon">球队描述</span><textarea value="<?php echo $resultb['teamDesc']; ?>" name="tdesc" type="text" placeholder="300字以内" class="form-control"></textarea></div><br />
                            <button type="button" class="layui-btn layui-btn-danger"><a href="admin_team.php" style="color:white">返回</a></button>
                            <input type="submit" value="确认" class="layui-btn layui-btn-normal">
                            <input type="reset" value="重置" class="layui-btn layui-btn-warm">
                        </div>
                    </form>
                </center>
            </div>
            <?php
            include('../mysqli_connect.php');
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $team_id = $_GET['id'];
                $team_Name = $_POST["tname"];
                $wrank = $_POST["wrank"];
                $win = $_POST["win"];
                $draw = $_POST["draw"];
                $fail = $_POST["fail"];
                $goal = $_POST["goal"];
                $coachs = $_POST["coachs"];
                $wrate = $_POST["wrate"];
                $tdesc = $_POST["tdesc"];
                $player_id=$_POST["player_id"];

                $sqla = "update team set teamName='{$team_Name}',worldRank=$wrank,wins=$win,draws=$draw,fails=$fail,goals=$goal,coach='{$coachs}',winRate=$wrate,teamDesc='{$tdesc}',bestPlayerId=$player_id where teamId=$team_id;";
                $resa = mysqli_query($dbc, $sqla);
                if ($resa == 1) {
                    echo "<script>alert('修改成功！')</script>";
                    echo "<script>window.location.href='admin_team.php'</script>";
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