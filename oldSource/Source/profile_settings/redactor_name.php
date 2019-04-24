<?php
	require_once("../connect.php");
	require_once("../auth/auth-class.php");
	$auth->auth('13zhora13@gmail.com','111111');
	$id_user = $auth->get_id();
	
	if ($_POST['rename'] != '') {
		$new_name = $_POST['rename'];
		$mysqli->query("UPDATE users SET firstname ='$new_name' WHERE id = $id_user");
	}
	if ($_POST['resurname'] != '') {
		$new_surname = $_POST['resurname'];
		$mysqli->query("UPDATE users SET lastname ='$new_surname' WHERE id = $id_user");
	}

	header("Location:index.php");
?>