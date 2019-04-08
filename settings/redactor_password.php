<?php
	
	session_start();
	require_once("connection_bd.php");

	$result = $mysqli->query("SELECT `password` FROM `users` WHERE `id` = 16") or die("Invalid query: " . mysql_error());

	$row = $result->fetch_assoc();

	if (MD5($_POST['password']) == $row['password']) {
		$new_pass = MD5(trim($_POST['newpassword']));
		$mysqli->query("UPDATE users SET password ='$new_pass' WHERE id=16");
	}
	else {
		echo "Введен неверный пароль";
	}
	

	header("Location:settings.php");
?>
