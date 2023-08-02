<?php
session_start();
$user_id = $_SESSION['userId'];
include('../mysqli_connect.php');
$sql = "select userName from user where userId={$user_id}";
$res = mysqli_query($dbc, $sql);
$result = mysqli_fetch_array($res);
header("Content-type:text/html; charset=utf-8");
$sqla = "select teamName,winRate from team;";
$resa = mysqli_query($dbc, $sqla);
$test = array();
$i = 0;
while ($row = mysqli_fetch_row($resa)) {
    $test[$i]['name'] = $row[0];
    $test[$i]['value'] = $row[1];
    $i = $i + 1;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>世界杯比赛系统</title>
    <link rel="icon" href="./img/足球.png" type="image/x-icon"/>
    <script src="../js/layui.js" charset="UTF-8"></script>
    <script src="../js/time.js"></script>
    <script src="../js/echarts.min.js"></script>
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
                <li class="layui-nav-item layui-hide-xs"><a href="">夺冠概率图</a></li>
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

        <div class="layui-body" style="padding-left:100px;">
        <div id="app" style="width: 800px;height: 600px;"></div>
        <script>
            var myCharts = echarts.init(document.querySelector('#app'))
            // 需要设置给饼图的数据
            //访问数组的元素
            var passed_array = <?php echo json_encode($test); ?>;
            //显示数组中的元素
            this.pieList = []
            for (let i = 0; i < passed_array.length; i++) {
                var d = new Object();
                d.name = this.passed_array[i]['name'];
                d.value = this.passed_array[i]['value'];
                this.pieList.push(d)
            }
            var option = {
                // 注意：饼图不是直角坐标系图表，就不用配置x轴和y轴了
                series: [{
                    type: 'pie', // 类型： 饼图
                    data: this.pieList, //数据
                    label: { //饼图文字的显示
                        show: true, //默认  显示文字
                        formatter: function(arg) {
                            console.log(arg);
                            return arg.name + +arg.percent + "%"
                        }
                    },
                     radius: 250, //饼图的半径
                    // radius: '20%' //百分比参照的事宽度和高度中较小的那一部分的一半来进行百分比设置
                    // 圆环
                    // radius: ['50%','80%']

                    // 南丁格尔图  饼图的每一个部分的半径是不同的
                    // roseType: 'radius',
                     selectedMode: 'single', //选中的效果，能够将选中的区域偏离圆点一小段距离
                    //selectedMode: 'multiple',
                    selectedOffset: 30
                }]
            }
            myCharts.setOption(option)
        </script>
    </div>
    </div>
</body>

</html>