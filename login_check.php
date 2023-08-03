

<?php
include('mysqli_connect.php');
$params=json_decode(file_get_contents("php://input"),true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = $params['account'];
	$password = $params['pass'];
}
$userSql = "select * from user where userId='{$id}' and userPassword='{$password}'";
$userRes = mysqli_query($dbc, $userSql);
if (!$userRes) {
	printf("Error: %s\n", mysqli_error($dbc));
	exit();
}
$result2 = mysqli_fetch_array($userRes);
if (mysqli_num_rows($userRes) == 1) {
	$userRole = "select userRole from user where userId={$id}";
	$userRole1 = mysqli_query($dbc, $userRole);
	$result1 = mysqli_fetch_array($userRole1);
	if ($result1['userRole'] == 1) {
		session_start();
		$_SESSION['userId'] = $id;
		// echo "<script>window.location='../admin/admin_index.php'</script>";
		$response = array('status' => true, 'message' => '登陆成功');
		echo json_encode($response);
	} else {
		// echo "<script>alert('欢迎用户');window.location='index.php';</script>";
		$response = array('status' => true, 'message' => '登陆成功');
		echo json_encode($response);
	}
} else {
	// echo "<script>alert(123);window.location='index.php';</script>";
	$response = array('status' => false, 'message' => '账号或密码错误');
	echo json_encode($response);
}



?>