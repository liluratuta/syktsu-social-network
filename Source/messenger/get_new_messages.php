<?php

	require_once("../connect.php");
	require_once("../auth/auth-class.php");

	if ( ($user_id = $auth->get_id()) === NULL) {
		echo "{
	 		\"header\":\"getNewMessages\",
	 		\"request_success\":\"false\"
	 	}";
		exit();
	}

	if ( ($chat_id = $_POST['chat_id']) === NULL ) {
		echo "{
	 		\"header\":\"getNewMessages\",
	 		\"request_success\":\"false\"
	 	}";
		exit();
	}
	
	$message_list = $mysqli->query("SELECT * from messages 
	 								   where chat_id=".$chat_id." and date > '".$_POST['current_date']."' order by date");

	if (mysqli_num_rows($message_list) == 0) {
		echo "{
	 		\"header\":\"getNewMessages\",
	 		\"request_success\":\"false\"
	 	}";
		exit();
	}

	$response = "{
			\"header\":\"getNewMessages\",
	 		\"request_success\":\"true\",
	 		\"message_list\":[
		";

	while ( $row = $message_list->fetch_assoc() ) {
		$user_data = ($mysqli->query("SELECT * from users where id=".$row['user_id']))->fetch_assoc();

		$response .= "{
			 	\"icon_src\":\"".$user_data['icon']."\",
			 	\"user_name\":\"".$user_data['firstname']." ".$user_data['lastname']."\",
			 	\"data\":\"".$row['data']."\",
			 	\"date\":\"".$row['date']."\"
			},";
	}

	$response = substr($response, 0, -1);
	$response .= "]}";

	echo $response;

?>