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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
</head>
<body>

	<div id="options_container">
		<?php echo "<form action=\"save_settings.php?chat_id=".$chat_id."\" method=\"POST\">"; ?>
			<div class="option_line">
				<label for="chat_name">chat name</label>
				<input id="chat_name" type="text" name="name">
			</div>
			<div class="option_line">
				<label for="chat_icon">chat icon</label>
				<input id="chat_icon" type="text" name="icon">
			</div>
			<div class="option_line">
				<label>chat access type</label>

				<label for="access_type_private">private</label>
				<input id="access_type_private" type="radio" name="access_type" value="0">

				<label for="access_type_public">public</label>
				<input id="access_type_public" type="radio" name="access_type" value="1">
			</div>
			<div class="option_line">
				<label>default_user_role </label>

				<label for="user_role_admin">admin</label>
				<input id="user_role_admin"  type="radio" name="default_user_role" value="0">

				<label for="user_role_writer">writer</label>
				<input id="user_role_writer" type="radio" name="default_user_role" value="1">

				<label for="user_role_reader">reader</label>
				<input id="user_role_reader" type="radio" name="default_user_role" value="2">
			</div>
			<div class="option_line">
				<input type="submit" name="save" value="save">
			</div>
		</form>
	</div>

</body>
</html>