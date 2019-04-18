<?php

	require_once("../connect.php");
	require_once("../auth/auth-class.php");

	if ( ($user_id = $auth->get_id()) === NULL) {
		echo "{
	 		\"header\":\"getLastMessages\",
	 		\"request_success\":\"false\"
	 	}";
		exit();
	}

	if ( ($chat_id = $_POST['chat_id']) === NULL ) {
		echo "{
	 		\"header\":\"getLastMessages\",
	 		\"request_success\":\"false\"
	 	}";
		exit();
	}
	
	$message_list = $mysqli->query("SELECT * from messages 
	 								   where chat_id=".$chat_id." order by id desc limit 10");

	if (mysqli_num_rows($message_list) == 0) {
		echo "{
	 		\"header\":\"getLastMessages\",
	 		\"request_success\":\"false\"
	 	}";
		exit();
	}

	$message_list = array_reverse($message_list);

	$response = "{
			\"header\":\"getLastMessages\",
	 		\"request_success\":\"true\",
	 		\"message_list\":[
		";

	while ( $row = $message_list->fetch_assoc() ) {
		$user_data = ($mysqli->query("SELECT * from users where id=".$row['user_id']))->fetch_assoc();

		$response .= "{
				\"user_id\":\"".$user_data['id']."\",
			 	\"icon_src\":\"".$user_data['icon']."\",
			 	\"user_name\":\"".$user_data['firstname']." ".$user_data['lastname']."\",
			 	\"data\":\"".htmlspecialchars_decode($row['data'])."\",
			 	\"date\":\"".$row['date']."\"
			},";
	}

	$response = substr($response, 0, -1);
	$response .= "]}";

	echo $response;

?>