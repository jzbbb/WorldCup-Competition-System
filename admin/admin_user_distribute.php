<?php
session_start();
$user_id = $_SESSION['userId'];
include('../mysqli_connect.php');
$sql = "select userName from user where userId={$user_id}";
$res = mysqli_query($dbc, $sql);
$result = mysqli_fetch_array($res);
header("Content-type:text/html; charset=utf-8");
$sqla = "select address,count(address) from user group by address;";
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
    <link rel="icon" href="./img/足球.png" type="image/x-icon"/>
    <title>世界杯比赛系统</title>
    <script src="../js/layui.js" charset="UTF-8"></script>
    <script src="../js/time.js"></script>
    <script src="../js/echarts.min.js"></script>
    <script src="../js/china.js"></script>
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
                <li class="layui-nav-item layui-hide-xs"><a href="">用户分布</a></li>
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

        <div class="layui-body" >
            <div id="china" style="height: 650px;width:1000px;margin:20px"></div>

            <script src="/static/js/echarts.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/map/js/china.js"></script>

            <script>
                // 初始化echarts实例
                var myEcharts = echarts.init(document.getElementById("china"));
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
                    title: { //标题样式
                        text: '用户分布',
                        x: "center",
                        textStyle: {
                            fontSize: 24,
                            color: "black"
                        },
                    },
                    tooltip: {
                        trigger: 'item',
                        formatter: function(params) {
                            console.log(params)
                            if (params.name) {
                                return params.name + ' : ' + (isNaN(params.value) ? 0 : parseInt(params.value));
                            }
                        }
                    },
                    visualMap: { //视觉映射组件
                        top: 'bottom',
                        left: 'right',

                        min: 5,
                        max: 40,
                        //text: ['High', 'Low'],
                        realtime: false, //拖拽时，是否实时更新
                        calculable: true, //是否显示拖拽用的手柄
                        inRange: {
                            color: ['lightskyblue', 'yellow', 'orangered']
                        }
                    },
                    series: [{
                        name: '模拟数据',
                        type: 'map',
                        mapType: 'china',
                        roam: false, //是否开启鼠标缩放和平移漫游
                        itemStyle: { //地图区域的多边形 图形样式
                            normal: { //是图形在默认状态下的样式
                                label: {
                                    show: true, //是否显示标签
                                    textStyle: {
                                        color: "black"
                                    }
                                }
                            },
                            zoom: 3.0, //地图缩放比例,默认为1
                            layoutSize: '120%',
                            emphasis: { //是图形在高亮状态下的样式,比如在鼠标悬浮或者图例联动高亮时
                                label: {
                                    show: true
                                }
                            }
                        },
                        data: this.pieList
                    }]
                };
                // 使用刚指定的配置项和数据显示图表。
                myEcharts.setOption(option);
            </script>

            

        </div>
</body>

</html>