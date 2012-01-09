<?php
	// MySQL connection
	
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$link = mysql_connect($db_host, $db_user, $db_pass);
	mysql_select_db("tt", $link);
	
	$url = "localhost/tt/"; // Site base url
	
	
?>