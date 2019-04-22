<?php
	require_once("../connect.php");
	require_once("../auth/auth-class.php");
	$auth->auth('13zhora13@gmail.com','111111');
	$id_user = $auth->get_id();

	$new_image = htmlspecialchars($_POST['picture']);
	$mysqli->query("UPDATE `users` SET `image_header` = '$new_image' WHERE `id` = $id_user");

	header("Location:index.php");
?>