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
		// Check if user exists in the database
		$query = "SELECT * FROM `t_users` WHERE id='".$user_profile['id']."'";
		$result = mysql_query($query, $link);
		if(mysql_num_rows($result) != 1) // New user
		{
			$query = "INSERT INTO `t_users` (id, name) VALUES ('".$user_profile['id']."', '".$user_profile['name']."')";
			mysql_query($query, $link);
		}
		echo '<meta http-equiv="refresh" content="1; url=index.php">';
	}
	else //user not connected
	{
		echo '<meta http-equiv="refresh" content="1; url='.$loginUrl.'">';
	}
	?>
  </body>
</html>