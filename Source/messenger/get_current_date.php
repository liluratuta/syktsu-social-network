<?php
	echo "{
		\"header\":\"getCurrentDate\",
		\"date\":\"".(new DateTime())->format('Y-m-d H:i:s')."\"
	}";
?>

