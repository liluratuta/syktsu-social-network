<?php
	require __DIR__.'\..\connect.php';
	require_once __DIR__.'\..\auth\auth-class.php';
	require __DIR__.'\..\const.php';

	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	inviteFriends(2,3);

	

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
		if (($key_in = array_search($out_user, $array_in_user)) == NULL)
			exit('Приглашение не найдено у получателя!');
		$array_out_user = getArrayFriendsById($out_user, 'my_invite');
		if (($key_out = array_search($in_user, $array_out_user)) == NULL)
			exit('Приглашение не найдено у отправителя!');

		unset($array_in_user[$key_in]);
		unset($array_out_user[$key_out]);

		sendArrayFriendsById($in_user, 'me_invite', $array_in_user);
		sendArrayFriendsById($out_user, 'my_invite', $array_out_user);

	}
	function inviteFriends($in_user, $out_user){
		$array_in_user = getArrayFriendsById($in_user, 'my_invite');
		$array_out_user = getArrayFriendsById($out_user, 'me_invite');

		if(array_search($out_user, $array_in_user) == NULL){
			array_push($array_in_user, $out_user);
			echo "true";
		}
		if(array_search($in_user, $array_out_user) == NULL){
			echo "true";
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
		$query = "SELECT '$type' FROM users WHERE id = '$id'"; 
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		$row = mysqli_fetch_assoc($result);
		$out_array = json_decode($row[$type]);
		if (!isset($out_array)) $out_array = [];
		return $out_array;
	}
?>