<?php
ini_set('display_errors', 1);
echo "check`";
require __DIR__.'\..\connect.php';
require __DIR__.'\..\const.php';
session_start(); //защита от спама
if(!isset($_SESSION['connection_count'])) 
	$_SESSION['connection_count'] = 1;
  else
	$_SESSION['connection_count'] += 1;

if($_SESSION['connection_count'] > $CONST_MAX_CONNECTION_COUNT){
	header( 'Location:'.$CONST_DOMEN."?conf=Внимание, сработала защита от спама!&type=bad" );
	exit();
} 

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$link->set_charset("utf8");

$query = "SELECT mail FROM users WHERE verification = '".$_GET['ver_code']."'"; 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_row($result);

if (!isset($row[0])) {
	header( 'Location:'.$CONST_DOMEN."?conf=Неверный проверочный код!&type=bad" );
	exit();
}
if (md5($row[0]) != $_GET['email']){
	header( 'Location:'.$CONST_DOMEN."?conf=Ошибка: адрес электронной почты не совпадает с проверочным кодом!&type=bad" );
	exit();
} 

$query = "UPDATE users SET verification = '' WHERE mail = '".$row[0]."'"; 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result) {
	header( 'Location:'.$CONST_DOMEN."?conf=Адрес электронной почты подтвержден! Теперь вы можете войти.&type=good" );
} else 
	header( 'Location:'.$CONST_DOMEN."?conf=Ошибка в БД!&type=bad" );

?>