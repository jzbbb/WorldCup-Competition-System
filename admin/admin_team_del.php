<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<body>

</body>

</html>
<?php
session_start();
$userid = $_SESSION['userId'];
include('../mysqli_connect.php');


$delid = $_GET['id'];



$sql = "delete  from team where teamId={$delid} ;";
$res = mysqli_query($dbc, $sql);

if ($res == 1) {
    echo "<script>alert('删除成功')</script>";
    echo "<script>window.location.href='admin_team.php'</script>";
} else {
    echo "删除失败";
    echo "<script>window.location.href='admin_team.php'</script>";
}


?>