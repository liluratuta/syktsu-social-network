<?php

	require_once("../connect.php");
	require_once("../auth/auth-class.php");
	$auth->auth('13zhora13@gmail.com','111111');
	$id_user = $auth->get_id();

	$result = $mysqli->query("SELECT `image_header` FROM `users` WHERE `id` = $id_user");

	$row = $result->fetch_assoc();
	//$mysqli->close();

	//echo '<img src="' . $row['image_header'] . '" alt="img"/><br/>';
	//$image = mysql_fetch_array($res);
	header("content-type:image/jpeg; charset=utf-8");
	echo $row['image_header'];
?>