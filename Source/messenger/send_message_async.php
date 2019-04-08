<?php

	require_once("../connect.php");
	require_once("../auth/auth-class.php");

	if ( ($user_id = $auth->get_id()) === NULL) {
		echo "{
			\"handlerType\":\"sendMessage\",
			\"requestSuccess\":\"false\"
		}";
		exit();
	}

	$chat_id = $_POST['chat_id'];

	$userchat_result = $mysqli->query("SELECT user_role from user_chat 
									   where chat_id=".$chat_id." and user_id=".$user_id);

	$user_role = ($userchat_result->fetch_assoc())['user_role'];

	if ($user_role == NULL || $user_role == 2) {
		echo "{
			\"handlerType\":\"sendMessage\",
			\"requestSuccess\":\"false\"
		}";
		exit();
	}

	if ($_POST['data'] != '') {
		$mysqli->query("INSERT INTO messages(id, user_id, chat_id, data, date) 
				    VALUES (NULL, ".$user_id.",".$chat_id.",'".$_POST['data']."',NOW())");
	}

	echo "{
			\"handlerType\":\"sendMessage\",
			\"requestSuccess\":\"true\"
		}";

?>