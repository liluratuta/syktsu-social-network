<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
		#auth-container {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);

			background: #efefef;
			border-radius: 8px;
		}

		.input-text {
			display: block;
			margin: 10px;

			border: none;
			background: #fff;
			border-radius: 10px;
			padding: 10px;
		}

		.input-submit {
			display: block;
			margin: 10px;

			border: none;
			padding: 10px;

			border-radius: 10px;
			background: #ff6347;
			color: #fff;
		}

		.input-submit:hover {
			background: #e5593f;
		}
	</style>
</head>
<body>

<div id="auth-container">
	<form action="test_auth.php" method="POST">
		<input class="input-text" type="text" name="login">
		<input class="input-text" type="password" name="password">
		<input class="input-submit" type="submit" value="Auth">
	</form>
</div>

</body>
</html>