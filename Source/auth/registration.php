<?php
require __DIR__.'\..\connect.php';
require_once __DIR__.'\auth-class.php';
require __DIR__.'\..\const.php';
require_once __DIR__.'\SendMailSmtpClass.php';


//if (@!$_POST['submit']) exit('Ошибка: отсутствует submit');//
$answer = [];
if ($_POST['password'] == ''){
  $answer['typemessage'] = 'bad';
  $answer['message'] = 'Внимание, введите пароль!';
  echo json_encode($answer);
  exit();
}
if ($_POST['password'] != $_POST['repassword']){
  $answer['typemessage'] = 'bad';
  $answer['message'] = 'Внимание, пароли не совпадают!';
  echo json_encode($answer);
  exit();
}  //проверяем пароли

if (!$auth->registration($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'])) {
  $answer['typemessage'] = 'bad';
  $answer['message'] = 'Внимание, адрес электронной почты уже используется!';
  echo json_encode($answer);
  exit();
}

// //проверочный код
$ver_code = generateVerificationCode($CONST_VER_LENGTH); //генерируем код


$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$link->set_charset("utf8");

$query = "UPDATE users SET verification = '".$ver_code."' WHERE mail = '".$_POST['email']."'"; //добавление кода в бд
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if(!$result) {
  $answer['typemessage'] = 'bad';
  $answer['message'] = 'Ошибка, при подключении к базе данных';
  echo json_encode($answer);
  exit();
}


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
    $answer['message'] = "На Ваш адрес электронной почты отправлено подтверждение";
    $answer['typemessage'] = 'good';
}else{
    $answer['message'] = "Письмо не отправлено. Ошибка: " . $result;
    $answer['typemessage'] = 'bad';
    $query = "DELETE FROM users WHERE mail = '".$_POST['email']."'"; //добавление кода в бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
}
echo json_encode($answer);
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