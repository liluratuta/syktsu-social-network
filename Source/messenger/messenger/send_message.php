<?php
	require_once("connect.php");

	if ( ($chat_id = $_GET['chat_id']) == NULL) {
		
		header("Location:index.php");
	}

	$userchat_result = $mysqli->query("SELECT user_role from user_chat 
									   where chat_id=".$chat_id." and user_id=".$user_id);

	$user_role = ($userchat_result->fetch_assoc())['user_role'];

	if ($user_role == NULL || $user_role == 2) {
		header("Location:index.php");
	}

	if ($_POST['data'] != '') {
		$mysqli->query("INSERT INTO messages(id, user_id, chat_id, data, date) 
				    VALUES (NULL, ".$user_id.",".$chat_id.",'".$_POST['data']."',NOW())");
	}
	// echo "INSERT INTO message(id, user_id, chat_id, data, date) 
	// 			    VALUES (NULL, ".$user_id.",".$chat_id.",'".$_POST['data']."',NOW())";
	header("Location:index.php?chat_id=".$chat_id);
?>