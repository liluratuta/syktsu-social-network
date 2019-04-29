<?php

	require_once("../connect.php");
	require_once("../auth/auth-class.php");

	if ( ($user_id = $auth->get_id()) === NULL) {
		echo "{
	 		\"header\":\"getUsersList\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	if ( ($chat_id = $_POST['chat_id']) === NULL ) {
		echo "{
	 		\"header\":\"getUsersList\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	$user_chat_data = ($mysqli->query("SELECT * from user_chat where user_id=".$user_id." AND chat_id=".$chat_id))->fetch_assoc();

	if ($user_chat_data['user_role'] != 0) {
		echo "{
	 		\"header\":\"getUsersList\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	$user_list = $mysqli->query("SELECT user_id, user_role from user_chat where chat_id=".$chat_id);

	$response = "{
			\"header\":\"getUsersList\",
	 		\"request_success\":true,
	 		\"users_list\":[
		";

	while ($row = $user_list->fetch_assoc()) {
		
		$user_data = ($mysqli->query("SELECT firstname, lastname, icon from users where id=".$row['user_id']))->fetch_assoc();

		$response .= "{
				\"id\":".$row['user_id'].",
			 	\"icon\":\"".$user_data['icon']."\",
			 	\"name\":\"".$user_data['firstname']." ".$user_data['lastname']."\",
			 	\"role\":".$row['user_role']."
			},";		

	}

	$response = substr($response, 0, -1);
	$response .= "]}";

	echo $response;

?>