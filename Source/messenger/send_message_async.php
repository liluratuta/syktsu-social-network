<?php
	// echo "string";
	require_once("../connect.php");
	require_once("../auth/auth-class.php");

	if ( ($user_id = $auth->get_id()) === NULL) {
		echo "{
	 		\"header\":\"sendMessage\",
	 		\"request_success\":\"false\"
	 	}";
		exit();
	}

	$chat_id = $_POST['chat_id'];
	// echo "data=".$_POST['data'];
	$userchat_result = $mysqli->query("SELECT user_role from user_chat 
									   where chat_id=".$chat_id." and user_id=".$user_id);

	$user_role = ($userchat_result->fetch_assoc())['user_role'];

	if ($user_role == NULL || $user_role == 2) {
		echo "{
			\"header\":\"sendMessage\",
			\"request_success\":\"false\"
		}";
		exit();
	}

	if ($_POST['data'] != '') {
		$mysqli->query("INSERT INTO messages(id, user_id, chat_id, data, date) 
				    VALUES (NULL, ".$user_id.",".$chat_id.",'".htmlspecialchars($_POST['data'])."',NOW())");
	}

	$user_data = ($mysqli->query("SELECT * from users where id=".$user_id))->fetch_assoc();

	echo "{
			\"header\":\"sendMessage\",
			\"request_success\":\"true\",
			\"icon_src\":\"".$user_data['icon']."\",
			\"user_name\":\"".$user_data['firstname']." ".$user_data['lastname']."\",
			\"data\":\"".$_POST['data']."\",
			\"date\":\"".(new DateTime())->format('Y-m-d H:i:s')."\"
		}";
		// (new DateTime())->format('Y-m-d H:i:s')


?>