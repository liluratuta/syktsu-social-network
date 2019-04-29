<?php

	require_once("../connect.php");
	require_once("../auth/auth-class.php");

	if ( ($user_id = $auth->get_id()) === NULL) {
		echo "{
	 		\"header\":\"getPoputMenuData\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	if ( ($chat_id = $_POST['chat_id']) === NULL ) {
		echo "{
	 		\"header\":\"getPoputMenuData\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	$user_chat_data = ($mysqli->query("SELECT * from user_chat where user_id=".$user_id." AND chat_id=".$chat_id))->fetch_assoc();

	if ($user_chat_data['user_role'] != 0) {
		echo "{
	 		\"header\":\"getPoputMenuData\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	$chat_data = ($mysqli->query("SELECT * from chats where id=".$chat_id))->fetch_assoc();

	echo "{
	 		\"header\":\"getPoputMenuData\",
	 		\"request_success\":true,
	 		\"data\": {
		 		\"name\":\"".$chat_data['name']."\",
		 		\"icon\":\"".$chat_data['icon']."\",
		 		\"access_type\":".$chat_data['access_type'].",
		 		\"default_user_role\":".$chat_data['default_user_role']."
		 	}
	 	}";

?>