<?php

	require_once("../connect.php");
	require_once("../auth/auth-class.php");

	if ( ($user_id = $auth->get_id()) === NULL) {
		echo "{
	 		\"header\":\"changeUserRole\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	if ( ($chat_id = $_POST['chat_id']) === NULL ) {
		echo "{
	 		\"header\":\"changeUserRole\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	$user_chat_data = ($mysqli->query("SELECT * from user_chat where user_id=".$user_id." AND chat_id=".$chat_id))->fetch_assoc();

	if ($user_chat_data['user_role'] != 0) {
		echo "{
	 		\"header\":\"changeUserRole\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	$mysqli->query("UPDATE user_chat SET user_role=".$_POST['role']." where user_id=".$_POST['change_user_id']." and chat_id=".$chat_id);

	echo "{
	 		\"header\":\"changeUserRole\",
	 		\"request_success\":true
	 	}";

?>