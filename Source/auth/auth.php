<?php
require_once __DIR__.'/auth-class.php';
require __DIR__.'/../connect.php';
require __DIR__.'/../const.php';

//if(!$_POST['submit']) exit('Ошибка: отсутствует submit');
//echo $_POST['email']."----".$_POST['password'];
$result = $auth->auth($_POST['email'],$_POST['password']);
$answer = [];
$answer['typemessage'] = 'bad';

if($result === true) {
	//header('Location: '.$CONST_DOMEN.'page?id='.$auth->get_id());
	$answer['typemessage'] = 'good';
	$answer['message'] = $auth->get_id();
}

if($result === false) 
	$answer['message'] = 'Неверные данные для входа!';

if($result === 2) 
	$answer['message'] = 'Адрес электронной почты не подтверждён!';

echo json_encode($answer);


?>