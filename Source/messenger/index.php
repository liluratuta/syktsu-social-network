<?php require_once("connect.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Site on php</title>
</head>
<body>

<?php
	$query = "select name from chat";

	//$result = mysql_query($connection, $query);

	$result = $mysqli->query($query);
	

	while ($row = $result->fetch_assoc()) {
		echo ":".$row['name'];
	}

?>

</body>
</html>