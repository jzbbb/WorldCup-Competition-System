<?php
session_start();
$user_id = $_SESSION['userId'];
include('../mysqli_connect.php');
$sql = "select userName from user where userId={$user_id}";
$res = mysqli_query($dbc, $sql);
$result = mysqli_fetch_array($res);
header("Content-type:text/html; charset=utf-8");
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
                <li class="layui-nav-item layui-hide-xs"><a href="">球员管理</a></li>
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
            <div style="padding: 15px;">
                <div class="layui-container">
                    <center>
                        <form id="query" action="admin_player.php" method="POST">
                            <div id="query">
                                <label><input name="teamquery" type="text" placeholder="请输入球员名字" class="form-control"></label>
                                <input type="submit" value="查询" class="layui-btn layui-btn-warm">
                                <button type="button" class="layui-btn layui-btn-normal"><a href="admin_player_add.php" style="color:white">增加球员</a></button>
                            </div>
                        </form>
                    </center>
                    <table class="layui-hide" id="table_user" lay-filter="test"></table>
                    <script type="text/html" id="actionBar">
                        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
                        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                    </script>
                    <script type="text/html" id="toolbarDemo">
                        <div class="layui-btn-container">
                            <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
                            <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
                            <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
                        </div>
                    </script>
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $gjc = $_POST["teamquery"];

                    $sqla = "select player.*,teamName from team,player where team.teamId=player.team_id and ( player_name like '%{$gjc}%' ) and player_id !=1 ;";
                } else {
                    $sqla = "select player.*,teamName from team,player where team.teamId=player.team_id and player_id !=1;";
                }
                $resa = mysqli_query($dbc, $sqla);
                $test = array();
                $i = 0;
                while ($row = mysqli_fetch_row($resa)) {
                    $test[$i]['player_id'] = $row[0];
                    $test[$i]['player_name'] = $row[1];
                    $test[$i]['player_num'] = $row[4];
                    $test[$i]['player_age'] = $row[3];
                    $test[$i]['height'] = $row[5];
                    $test[$i]['player_club'] = $row[6];
                    $test[$i]['player_salary'] = $row[7];
                    $test[$i]['player_pos'] = $row[8];
                    $test[$i]['player_score'] = $row[9];
                    $test[$i]['birth_date'] = $row[10];
                    $test[$i]['teamName'] = $row[13];
                    $i = $i + 1;
                }
                ?>
                <script>
                    var passed_array = <?php echo json_encode($test); ?>;
                    this.data = [];
                    for (let i = 0; i < this.passed_array.length; i++) {
                        var d = new Object();
                        d.player_id = this.passed_array[i]['player_id'];
                        d.player_name = this.passed_array[i]['player_name'];
                        d.player_num = this.passed_array[i]['player_num'];
                        d.height = this.passed_array[i]['height'];
                        d.player_club = this.passed_array[i]['player_club'];
                        d.player_salary = this.passed_array[i]['player_salary'];
                        d.player_pos = this.passed_array[i]['player_pos'];
                        d.player_score = this.passed_array[i]['player_score'];
                        d.birth_date = this.passed_array[i]['birth_date'];
                        d.teamName = this.passed_array[i]['teamName'];
                        d.player_age = this.passed_array[i]['player_age'];
                        this.data.push(d);
                    }
                    //显示数组中的元素
                    layui.use(['table'], function() {
                        table = layui.table;
                        table.render({
                            elem: '#table_user',
                            height: 500,
                            width: 1025,
                            data: getData(),
                            title: '球队表',
                            page: true //开启分页
                                ,
                             toolbar: '#toolbarDemo', 
                            limit: 6, //设置每页显示条数,根据自己项目情况去设置
                            limits: [6, 10, 15, 20, 25, 30, 35] //设置每页条数下拉框的选择项,就是分页那一栏的下拉框选项
                                ,
                            cols: [
                                [ //表头
                                    {
                                        type: 'checkbox',
                                        fixed: 'left'
                                    },
                                    {
                                        field: 'player_id',
                                        fixed: 'left',
                                        title: '球员Id',
                                        align: 'center',
                                        width: 90,
                                        style: 'background-color: #eee;',
                                        sort: true
                                    },
                                    {
                                        field: 'player_name',
                                        title: '球员名',
                                        align: 'center',
                                        width: 105
                                    }, {
                                        field: 'player_num',
                                        title: '球员号码',
                                        align: 'center',
                                        templet: '#teamTpl',
                                        width: 90
                                    }, {
                                        field: 'height',
                                        title: '身高',
                                        width: 90,
                                        align: 'center',
                                        sort: true
                                    },{
                                        field: 'player_age',
                                        title: '年龄',
                                        align: 'center',
                                        width: 100,
                                        sort:true
                                    },{
                                        field: 'player_club',
                                        title: '俱乐部',
                                        width: 120,
                                        align: 'center'
                                    }, {
                                        field: 'player_salary',
                                        title: '年薪(万欧元)',
                                        width: 130,
                                        align: 'center',
                                        sort: true
                                    }, {
                                        field: 'player_pos',
                                        title: '位置',
                                        align: 'center',
                                        width: 80
                                    }, {
                                        field: 'player_score',
                                        title: '进球数',
                                        width: 105,
                                        align: 'center',
                                        sort: true
                                    }, {
                                        field: 'birth_date',
                                        title: '生日',
                                        width: 120,
                                        align: 'center'
                                    }, {
                                        field: 'teamName',
                                        title: '队伍名',
                                        align: 'center',
                                        width: 105
                                    },
                                    {
                                        fixed:"right",
                                        title: '操作',
                                        width: 180,
                                        align: 'center',
                                        toolbar: '#actionBar'
                                    }
                                ]
                            ],
                            size: 'lg'
                        });

                        table.on('toolbar(test)', function(obj) {
                            var checkStatus = table.checkStatus(obj.config.id);
                            switch (obj.event) {
                                case 'getCheckData':
                                    var data = checkStatus.data;
                                    layer.alert(JSON.stringify(data));
                                    break;
                                case 'getCheckLength':
                                    var data = checkStatus.data;
                                    layer.msg('选中了：' + data.length + ' 个');
                                    break;
                                case 'isAll':
                                    layer.msg(checkStatus.isAll ? '全选' : '未全选');
                                    break;

                                    //自定义头工具栏右侧图标 - 提示
                                case 'LAYTABLE_TIPS':
                                    layer.alert('这是工具栏右侧自定义的一个图标按钮');
                                    break;
                            };
                        });


                        function getData() {
                            return this.data;
                        }

                        //监听行工具事件
                        table.on('tool(test)', function(obj) {
                            //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                            var data = obj.data //获得当前行数据
                                ,
                                layEvent = obj.event; //获得 lay-event 对应的值

                            if (layEvent === 'detail') {
                                window.location.href = "admin_player_view.php?id=" + data.player_id;
                            } else if (layEvent === 'del') {
                                window.location.href = "admin_player_del.php?id=" + data.player_id;
                            } else if (layEvent === 'edit') {
                                window.location.href = "admin_player_modify.php?id=" + data.player_id;
                            }
                        });
                    })
                </script>


            </div>
        </div>

        <div class="layui-footer">
            <div id="Date" class="text-center layui-icon layui-icon-time"></div>
        </div>

        <script>
            layui.use('element',function(){
		var element = layui.element;
	});
</script>
    </div>
</body>

</html>