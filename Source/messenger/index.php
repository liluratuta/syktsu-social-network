<?php 
	require_once("connect.php");
?>

<?php
	function showChatPreview($chat_data) {

		echo "<a class=\"сhat-preview\" href=\"?chat_id=".$chat_data['id']."\">
		<img class=\"chat_icon\" src=\"".$chat_data['icon']."\">".$chat_data['name']."</a>";
	}

	function showChatList($user_id) {
		global $mysqli;

		echo "<div id=\"chat_list\">";
		
		$result = $mysqli->query("SELECT chat_id from user_chat where user_id=".$user_id);
		
		while ($row = $result->fetch_assoc()) {

			$chat_data = ($mysqli->query("SELECT * from chats where id=".$row['chat_id']))->fetch_assoc();
			showChatPreview($chat_data);

		}
		
		echo "</div>";
	}

	// RIGHT CONTAINER

	function showDefaultLabel() {
		echo "<p id=\"default_label\">Пожалуйста, выберите чат в левой части страницы</p>";
	}

	function showChatHeader($chat_id, $chat_data, $user_role) {

		echo "<div id=\"chat_info_container\">";
		echo "<img class=\"chat_icon\" src=\"".$chat_data['icon']."\">";
		echo "<div id=\"chat_info_title\">".$chat_data['name']."</div>";
		
		if ($user_role == 0) {
			echo "<a id=\"options_button\" href=\"settings.php?chat_id=".$chat_id."\">...</a>";
		}
	
		echo "</div>";
	}

	function showMessage($user_data, $message_data) {
		echo "<div class=\"message_box\">";
		echo "<img class=\"user_icon\" src=\"".$user_data['icon']."\">";
		echo "<p>".$user_data['firstname']." ".$user_data['lastname']."</p>";
		echo "<p>".$message_data['data']."</p>";
		echo "<p>".$message_data['date']."</p>";
		echo "</div>";
	}

	function showMessageList($chat_id) {
		global $mysqli;

		echo "<div id=\"message_list_container\">";

		$m_list = $mysqli->query("SELECT * from messages 
								 where chat_id=".$chat_id." order by date desc limit 5");

		while ($m_row = $m_list->fetch_assoc()) {
			$user_data = ($mysqli->query("SELECT * from users where id=".$m_row['user_id']))->fetch_assoc();

			echo "<div class=\"message_list_line\">";
			
			showMessage($user_data, $m_row);

			echo "</div>";
		}

		echo "</div>";
	}

	function showSendForm($chat_id) {
		echo "<div id=\"send_form_container\">";
		echo "<form action=\"send_message.php?chat_id=".$chat_id."\" method=\"POST\">";
		echo "<input style=\"width: 60%;\" type=\"text\" name=\"data\">";
		echo "<input type=\"submit\" name=\"sender\" value=\"send\">";
		echo "</form>";
		echo "</div>";
	}

	function showRightSide($user_id) {
		global $mysqli;

		if ( ($chat_id = $_GET['chat_id']) == NULL) {
			showDefaultLabel();
			return;
		}

		$userchat_result = $mysqli->query("SELECT user_role from user_chat where chat_id=".$chat_id." and user_id=".$user_id);

		$user_role = ($userchat_result->fetch_assoc())['user_role'];

		// user role {
		//		0 - admin
		//		1 - writer
		//		2 - reader
		// }

		$chat_data = ($mysqli->query("SELECT * from chats where id=".$chat_id))->fetch_assoc();

		if ($user_role == NULL) { // Проверка на доступ user к chat
			
			if ($chat_data['access_type'] != 1) {
				showDefaultLabel();
				return;
			}
			
			// Если чат публичный, т.е. access_type == 1 , добавляем user к чату

			$mysqli->query("INSERT into user_chat(user_id, chat_id, user_role)
			 				values (".$user_id.",".$chat_id.",".$chat_data['default_user_role'].")");

			header("Location:index.php?chat_id=".$chat_id);
			exit();

		}
		
		showChatHeader($chat_id, $chat_data, $user_role);
		showMessageList($chat_id);

		if ($user_role < 2) {
			showSendForm($chat_id);
		}
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/messenger.css">
</head>
<body>

<div id="main_container">
	
	<div id="left_container">
		
		<a id="create-chat_button" href="create_new_chat.php">создать чат</a>
		
		<?php showChatList($user_id);?>
		

	</div>
	<div id="right_container">
		
		<?php showRightSide($user_id); ?>		
		
	</div>

	<div id="cover"></div>

	<div id="poput">
		<div id="poput-menu">
			
			<input id="poput-menu-element-settings" class="poput-menu-element-radio" type="radio" name="poput-menu-element">
			<label for="poput-menu-element-settings">Настройки</label>

			<input id="poput-menu-element-users" class="poput-menu-element-radio" type="radio" name="poput-menu-element" >
			<label for="poput-menu-element-users">Участники</label>

			<input id="poput-menu-element-addusers" class="poput-menu-element-radio" type="radio" name="poput-menu-element">
			<label for="poput-menu-element-addusers">Добавить друзей</label>

		</div>
		<div id="poput-body">
			<?php require_once("settings-test.php"); ?>
		</div>
	</div>

	

</div>

</body>
</html>