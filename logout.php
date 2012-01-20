<?php
	include 'inc/config.php';
	if ($_SESSION['logat'])
	{
		session_destroy();
		$_SESSION['logat'] = false;
		echo 'Logout from facebook...<meta http-equiv="refresh" content="2; url='.$logoutUrl.'">';
	}
	else
		echo 'Done!<meta http-equiv="refresh" content="2; url=index.php">';
?>