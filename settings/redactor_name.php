<?php
	
	session_start();
	require_once("connection_bd.php");

	$result = $mysqli->query("SELECT * FROM `users` WHERE `id` = 16") or die("Invalid query: " . mysql_error());

	$row = $result->fetch_assoc();
	if ($_POST['rename'] != '') {
		$new_name = $_POST['rename'];
		$mysqli->query("UPDATE users SET firstname ='$new_name' WHERE id=16");
	}
	if ($_POST['resurname'] != '') {
		$new_surname = $_POST['resurname'];
		$mysqli->query("UPDATE users SET lastname ='$new_surname' WHERE id=16");
	}

	header("Location:settings.php");
?>