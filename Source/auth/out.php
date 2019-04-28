<?php
require_once __DIR__.'/auth-class.php';

if ($auth->out())
	echo 'good';
?>