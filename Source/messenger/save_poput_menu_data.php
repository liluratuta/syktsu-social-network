<?php

	require_once("../connect.php");
	require_once("../auth/auth-class.php");

	if ( ($user_id = $auth->get_id()) === NULL) {
		echo "{
	 		\"header\":\"savePoputMenuData\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	if ( ($chat_id = $_POST['chat_id']) === NULL ) {
		echo "{
	 		\"header\":\"savePoputMenuData\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	$user_chat_data = ($mysqli->query("SELECT * from user_chat where user_id=".$user_id." AND chat_id=".$chat_id))->fetch_assoc();

	if ($user_chat_data['user_role'] != 0) {
		echo "{
	 		\"header\":\"savePoputMenuData\",
	 		\"request_success\":false
	 	}";
		exit();
	}

	$mysqli->query("UPDATE chats SET name=".$_POST['name'].", icon=".$_POST['icon'].", access_type=".$_POST['access_type'].", default_user_role=".$_POST['default_user_role']." where id=".$chat_id);

	// header("location: index.php?chat_id=".$chat_id);

	echo "{
	 		\"header\":\"savePoputMenuData\",
	 		\"request_success\":true
	 	}";

?>