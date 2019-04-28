<?php
	require __DIR__.'/../connect.php';
	require_once __DIR__.'/../auth/auth-class.php';
	require __DIR__.'/../const.php';

	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	DoFunc($_POST['name_func'], $_POST['in_user'], $_POST['out_user']);

	function DoFunc($name_func, $in_user, $out_user){

		switch ($name_func) {
		    case 'inviteFriends':
		        inviteFriends($in_user, $out_user);
		        break;
		    case 'acceptInviteFriends':
		        acceptInviteFriends($in_user, $out_user);
		        break;
		    case 'cancelInviteFriends':
		        cancelInviteFriends($in_user, $out_user);
		        break;
		    case 'deleteFriends':
		        deleteFriends($in_user, $out_user);
		        break;
			}
	}
	function deleteFriends($in_user, $out_user){
		$array_in_user = getArrayFriendsById($in_user, 'friends');
		$array_out_user = getArrayFriendsById($out_user, 'friends');

		if (in_array($out_user, $array_in_user) == NULL)
			exit('Друг не найден у отправителя!');
		if (in_array($in_user, $array_out_user) == NULL)
			exit('Друг не найден у получателя!');

		$array_in_user = deleteElemArray($out_user, $array_in_user);
		$array_out_user = deleteElemArray($in_user, $array_out_user);
		// $key_in = array_search($out_user, $array_in_user);
		// $key_out = array_search($in_user, $array_out_user);
		// unset($array_in_user[$key_in]);
		// unset($array_out_user[$key_out]);

		sendArrayFriendsById($in_user, 'friends', $array_in_user);
		sendArrayFriendsById($out_user, 'friends', $array_out_user);	
	}
	function acceptInviteFriends($in_user, $out_user){
		cancelInviteFriends($in_user, $out_user);	

		$array_in_user = getArrayFriendsById($in_user, 'friends');
		$array_out_user = getArrayFriendsById($out_user, 'friends');

		array_push($array_in_user, $out_user);
		array_push($array_out_user, $in_user);

		sendArrayFriendsById($in_user, 'friends', $array_in_user);
		sendArrayFriendsById($out_user, 'friends', $array_out_user);
	}
	function cancelInviteFriends($in_user, $out_user){
		$array_in_user = getArrayFriendsById($in_user, 'me_invite');
		$array_out_user = getArrayFriendsById($out_user, 'my_invite');

		if (in_array($out_user, $array_in_user) == NULL)
			exit('Приглашение не найдено у получателя!');
		if (in_array($in_user, $array_out_user) == NULL)
			exit('Приглашение не найдено у отправителя!');

		$array_in_user = deleteElemArray($out_user, $array_in_user);
		$array_out_user = deleteElemArray($in_user, $array_out_user);
		
		// $key_in = array_search($out_user, $array_in_user);
		// $key_out = array_search($in_user, $array_out_user);
		// unset($array_in_user[$key_in]);
		// unset($array_out_user[$key_out]);

		sendArrayFriendsById($in_user, 'me_invite', $array_in_user);
		sendArrayFriendsById($out_user, 'my_invite', $array_out_user);

	}
	function inviteFriends($in_user, $out_user){
		$array_in_user = getArrayFriendsById($in_user, 'my_invite');
		$array_out_user = getArrayFriendsById($out_user, 'me_invite');

		if(in_array($out_user, $array_in_user) == NULL){
			array_push($array_in_user, $out_user);
			//echo "true";
		}
		if(in_array($in_user, $array_out_user) == NULL){
			//echo "true";
			array_push($array_out_user, $in_user);
		}

		sendArrayFriendsById($in_user, 'my_invite', $array_in_user);
		sendArrayFriendsById($out_user, 'me_invite', $array_out_user);
	}

	function sendArrayFriendsById($id, $type, $array){
		global $link;
		$send_str = json_encode($array);
		$query = "UPDATE users SET $type = '$send_str' WHERE id = '$id'"; 
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	}

	function getArrayFriendsById($id, $type){
		global $link;
		$query = "SELECT $type FROM users WHERE id = '$id'"; 
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		$row = mysqli_fetch_assoc($result);
		$out_array = json_decode($row[$type]);
		if (!isset($out_array)) $out_array = [];
		return $out_array;
	}
	function deleteElemArray($elem, $array){
		$key = array_search($elem, $array);
		unset($array[$key]);
		sort($array);
		return $array;

	}
?>