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
		$_SESSION['uid'] = $user_profile['id'];
		$_SESSION['name'] = $user_profile['name'];
		if($status) // New user
		{
			switch ($_GET['p'])
			{
				case '' :
					echo 'Hello '.$_SESSION['name'].'! This is the first time you logged in.<br>Please choose your map:';
					echo '
						<form method = "post" action = "login.php?p=cmap">
							<select name = "c_map">';
								$query = "SELECT * FROM `t_maps` WHERE nrc < max AND premium = 0";
								$result = mysql_query ($query, $link);
								while ($row = mysql_fetch_array($result))
									echo '<option value = "'.$row['name'].'">'.$row['name'].'</option>';
					echo '	</select>
							<input type = "submit" value = "Submit">
						</form>
					';
					break;
				case 'cmap':
					$_SESSION['money'] = 2500.0;
					$_SESSION['exp'] = 0;
					$_SESSION['lvl'] = 0;
					$_SESSION['rank'] = "user";
					$_SESSION['m_name'] = $_POST['c_map'];
					// insert user in the database
					$query = "INSERT INTO `t_users` (id, name, map) VALUES ('".$user_profile['id']."', '".$user_profile['name']."', '".$_SESSION['m_name']."')";
					mysql_query($query, $link);
					// set the new number of players on the choosen map
					$query = "UPDATE `t_maps` SET nrc = nrc + 1 WHERE name = '".$_SESSION['m_name']."'";
					$result = mysql_query ($query, $link);
					echo 'Done <meta http-equiv="refresh" content="3; url=index.php">';
					break;
			}
		}
		else
		{
			$row = mysql_fetch_array($result);
			$_SESSION['money'] = $row['money'];
			$_SESSION['exp'] = $row['exp'];
			$_SESSION['lvl'] = $row['lvl'];
			$_SESSION['map'] = $row['map'];
			$_SESSION['rank'] = $row['rank'];
			echo '<meta http-equiv="refresh" content="1; url=index.php">';
		}
	}
	else //user not connected
	{
		echo '<meta http-equiv="refresh" content="1; url='.$loginUrl.'">';
	}
	?>
  </body>
</html>