<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
</body>

</html>


<?php
include('mysqli_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["account"];
    $password = $_POST["pass"];
}
$usersql = "select * from user where userId={$id} and userPassword='{$password}'";
$userres = mysqli_query($dbc, $usersql);
$result2 = mysqli_fetch_array($userres);



if (mysqli_num_rows($userres) == 1) {
    $userRole = "select userRole from user where userId={$id}";
    $userRole1 = mysqli_query($dbc, $userRole);
    $result1 = mysqli_fetch_array($userRole1);
    if ($result1['userRole'] == 1) {
        session_start();
        $_SESSION['userId'] = $id;
        echo "<script>window.location='../admin/admin_index.php'</script>";
    } else {
        echo "<script>alert('欢迎用户');window.location='index.php'
    ;</script>";
    }
} else {
    echo "<script>alert('用户名或密码错误，请重新输入!');window.location='index.php'
    ;</script>";
}



?>