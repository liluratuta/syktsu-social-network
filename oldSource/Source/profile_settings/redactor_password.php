<?php
	require_once("../connect.php");
	require_once("../auth/auth-class.php");
	$auth->auth('13zhora13@gmail.com','111111');
	$id_user = $auth->get_id();

	$result = $mysqli->query("SELECT `password` FROM `users` WHERE `id` = $id_user") or die("Invalid query: " . $mysqli->connect_errno);

	$row = $result->fetch_assoc();

	if (MD5($_POST['password']) == $row['password']) {
		$new_pass = MD5(trim($_POST['newpassword']));
		$mysqli->query("UPDATE users SET password ='$new_pass' WHERE id = $id_user");
	}
	else {
		echo "Введен неверный пароль";
	}
	

	header("Location:index.php");
?>
