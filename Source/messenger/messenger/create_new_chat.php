<?php
	require_once("connect.php");

	$chat_id = (($mysqli->query("SELECT max(id) from chats"))->fetch_array())[0] + 1;
	
	$mysqli->query("INSERT into chats(id, name, icon, access_type, default_user_role)
				    values (".$chat_id.",'chat №".$chat_id."',
				    'https://www.surrealist.com.tr/images/photos/online-havaalani-transfer-sistemimizin-baslica-ozellikleri_69098973074826520999.jpg',
				    0,1)");
	
	$mysqli->query("INSERT into user_chat(user_id, chat_id, user_role)
				    values (".$user_id.",".$chat_id.",0)");

	header("Location:index.php?chat_id=".$chat_id);
?>