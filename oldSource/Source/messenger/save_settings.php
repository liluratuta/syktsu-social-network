<?php
	require_once("connect.php");

	if ( ($chat_id = $_GET['chat_id']) == NULL) {
		
		header("Location:index.php");
	}

	$userchat_result = $mysqli->query("SELECT user_role from user_chat 
									   where chat_id=".$chat_id." and user_id=".$user_id);

	$user_role = ($userchat_result->fetch_assoc())['user_role'];

	if ($user_role == NULL || $user_role != 0) {
		header("Location:index.php");
	}

	$mysqli->query("UPDATE chats set name='".$_POST['name']."', icon='".$_POST['icon']."', 
							access_type=".$_POST['access_type'].", default_user_role=".$_POST['default_user_role']."
							where id=".$chat_id);

	header("Location:index.php?chat_id=".$chat_id);
?>