<?php
	
	session_start();
	require_once("connection_bd.php");

	$result = $mysqli->query("SELECT `image_head` FROM `image_header` WHERE `id_user` = 16") or die("Invalid query: " . mysql_error());
	$row = $result->fetch_assoc();
	$new_image = $_POST['picture'];
	//$mysqli->query("UPDATE `image_header` SET `image_head` ='$new_image' WHERE `id_users` = 16");
	$mysqli->query("INSERT INTO image_header(image_head) VALUES (".htmlspecialchars($_POST['picture']).")");

	//header("Location:settings.php");
?>