<?php
require_once 'auth-class.php';
require '../connect.php';
require '../const.php';
require_once 'SendMailSmtpClass.php';


if (@!$_POST['submit']) exit('Ошибка: отсутствует submit');//

if ($_POST['password'] != $_POST['repassword']) exit('Внимание: пароли не совпадают!'); //проверяем пароли

if (!$auth->registration($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'])) //
	exit ('Внимание: адрес электронной почты используется!');

// //проверочный код
$ver_code = generateVerificationCode($CONST_VER_LENGTH); //генерируем код


$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$link->set_charset("utf8");

$query = "UPDATE users SET verification = '".$ver_code."' WHERE mail = '".$_POST['email']."'"; //добавление кода в бд
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if(!$result) exit('Ошибка подключения к БД::line : 22');


$mailSMTP = new SendMailSmtpClass($SMTP_user, $SMTP_password, $SMTP_server, $SMTP_sender_name, $SMTP_port); //отправление кода на емаил 
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
$headers .= "From: ".$SMTP_sender_name." <".$SMTP_user.">\r\n"; // от кого письмо

$email = md5($_POST['email']);
$mail_body = 'Для подтверждения электронной почты пройдите по ссылке: <br>';
$mail_body .= $CONST_DOMEN."Source/auth/confirmation.php?email=".$email;
$mail_body .= "&ver_code=".$ver_code;

$result =  $mailSMTP->send($_POST['email'], 'Подтверждение адреса электронной почты', $mail_body, $headers); // отправляем письмо
// $result =  $mailSMTP->send('Кому письмо', 'Тема письма', 'Текст письма', 'Заголовки письма');
if($result === true){
    echo "На Ваш адрес электронной почты отправлено подтверждение";
}else{
    echo "Письмо не отправлено. Ошибка: " . $result;
    $query = "DELETE FROM users WHERE mail = '".$_POST['email']."'"; //добавление кода в бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
}
mysqli_close($link);





function generateVerificationCode($length = 8){
  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}
?>