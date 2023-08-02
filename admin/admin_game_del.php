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



$sql = "delete  from game where game_id={$delid} ;";
$res = mysqli_query($dbc, $sql);

if ($res == 1) {
    echo "<script>alert('É¾³ý³É¹¦£¡')</script>";
    echo "<script>window.location.href='admin_groupgame.php'</script>";
} else {
    echo "<script>alert('É¾³ýÊ§°Ü£¡')</script>";
    echo "<script>window.location.href='admin_groupgame.php'</script>";
}


?>