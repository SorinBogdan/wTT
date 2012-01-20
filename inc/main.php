<?php
	include 'config.php';
	function getUserInfo($link) {
		$query = "SELECT * FROM `t_users` WHERE userid = ".$_SESSION['uid'];
		$result = mysql_query ($query, $link);
		$row = mysql_fetch_array($result);
		$_SESSION['money'] = $row['money'];
		$_SESSION['exp'] = $row['exp'];
		$_SESSION['lvl'] = $row['lvl'];
		$_SESSION['map'] = $row['map'];
	}
?>