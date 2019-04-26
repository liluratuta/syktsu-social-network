<?php
require_once __DIR__.'\..\connect.php';
require_once __DIR__.'\auth-class.php';
echo $auth->auth('thedarkarthur@gmail.com', '1112');
?>