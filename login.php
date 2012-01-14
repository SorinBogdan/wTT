<?php
	include 'inc/config.php';
	include 'inc/fb_get.php';
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" >
  </head>
  <body>
	<?php
	if ($user) // if user is succesfuly connected
	{
		$_SESSION['logat'] = true;
		// Check if user exists in the database
		$query = "SELECT * FROM `t_users` WHERE id='".$user_profile['id']."'";
		$result = mysql_query($query, $link);
		$status = (mysql_num_rows($result) != 1) ? true : false; // true - new user ; false - user exists
		if($status) // New user
		{
			$query = "INSERT INTO `t_users` (id, name) VALUES ('".$user_profile['id']."', '".$user_profile['name']."')";
			mysql_query($query, $link);
			$_SESSION['money'] = 2500.0;
			$_SESSION['exp'] = 0;
			$_SESSION['lvl'] = 0;
			$_SESSION['rank'] = "user";
		}
		else
		{
			$row = mysql_fetch_array($result);
			$_SESSION['money'] = $row['money'];
			$_SESSION['exp'] = $row['exp'];
			$_SESSION['lvl'] = $row['lvl'];
			$_SESSION['rank'] = $row['rank'];
		}
		$_SESSION['uid'] = $user_profile['id'];
		$_SESSION['name'] = $user_profile['name'];
		echo '<meta http-equiv="refresh" content="1; url=index.php">';
	}
	else //user not connected
	{
		echo '<meta http-equiv="refresh" content="1; url='.$loginUrl.'">';
	}
	?>
  </body>
</html>