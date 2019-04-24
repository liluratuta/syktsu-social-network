<?php
require_once 'auth-class.php';
require '../connect.php';

if(!$_POST['submit']) exit('Ошибка: отсутствует submit');
$result = $auth->auth($_POST['email'],$_POST['password']);

if($result === true) echo 'Вход выполнен';

if($result === false) echo 'Неверные данные для входа';

if($result === 2) echo 'Адрес электронной почты не подтвержден';

?>