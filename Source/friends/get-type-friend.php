<?php
	function getTypeFriend($elem, $id_auth_user){
		$elem['friends'] = parseJSON($elem['friends']);
		$elem['my_invite'] = parseJSON($elem['my_invite']);
		$elem['me_invite'] = parseJSON($elem['me_invite']);

		if(in_array($id_auth_user,$elem['friends'])){
			$elem['type'] = $elem['firstname']." Ваш друг";
			$elem['hover'] = 'Убрать из друзей';
			$elem['function'] = 'deleteFriends';
		}
		else if (in_array($id_auth_user,$elem['my_invite'])){
			$elem['type'] = "Вы отправили приглашение";
			$elem['hover'] = 'Отменить приглашение';
			$elem['function'] = 'inverseCancelInviteFriends';
		}
		else if (in_array($id_auth_user,$elem['me_invite'])){
			$elem['type'] = "Отправил Вам заявку";
			$elem['hover'] = 'Отменить приглашение';
			$elem['function'] = 'сancelInviteFriends';
		}
		else {
			$elem['type'] = $elem['firstname']." Вам не друг";
			$elem['hover'] = 'Социализироваться';
			$elem['function'] = 'inviteFriends';
		}
		unset($elem['friends']);
		unset($elem['my_invite']);
		unset($elem['me_invite']);

		return $elem;

	}
	function parseJSON($elem){
		$out_array = json_decode($elem);
		if (!isset($out_array)) $out_array = [];
		return $out_array;
	}
?>