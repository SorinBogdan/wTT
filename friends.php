<?php include 'inc/config.php'; ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style/style.css" >
	</head>
	<body>
		<div class = "cont">
			<?php
				
			?>
		</div>
		<?php
			switch ($_GET['action']) {
				case '':
					$query = "SELECT * FROM `t_friends` WHERE userid = '".$_SESSION['uid']."'";
					$result = mysql_query($query, $link);
					if(mysql_num_rows($result) < 1)
						echo 'You don\'t have any friends. <a href = "friends.php?action=add">Click here to add some</a>';
					else
						echo '<a href = "friends.php?action=add">Add more</a>';
						while ($row = mysql_fetch_array($result))
						{
							$query1 = "SELECT * FROM `t_users` WHERE userid = '".$row['friendid']."'";
							$result1 = mysql_query($query1, $link);
							$row1 = mysql_fetch_array($result1);
							$status = ($row['status'] == "c") ? "confirmed" : "pending";
							echo '<div class = "f_box">';
								echo $row1['name'].'<br>Status: '.$status;
								if ($row['status'] == "c")
									echo '<br>Lvl: '.$row1['lvl'].'<br>Money: '.$row1['money'];
								echo '<br><a href = "friends.php?action=delete&friendid='.$row['friendid'].'">Delete</a>';
							echo '</div>';
						}
						break;
				case 'delete':
					$query = "DELETE FROM `t_friends` WHERE userid = ".$_SESSION['uid']." AND friendid = ".$_GET['friendid'];
					$result = mysql_query($query, $link);
					if ($result)
						echo 'User succesfully deleted <meta http-equiv="refresh" content="2; url=friends.php">';
					break;
				case 'add':
					if (!isset ($_GET['id']))
					{
						
						echo '<table>';
							$query = "SELECT * FROM `t_users` WHERE userid != '".$_SESSION['uid']."'";
							$result = mysql_query($query, $link);
							while ($row = mysql_fetch_array($result))
							{
								echo '<tr>';
									echo '<td>'.$row['name'].'</td>';
									echo '<td> <a href = "friends.php?action=add&id='.$row['userid'].'">Add</a> </td>';
							}
						echo '</table>';
					}
					else
					{
						$query = "SELECT * FROM `t_friends` WHERE userid = '".$_SESSION['uid']."' AND friendid = '".$_GET['id']."'";
						$result = mysql_query ($query, $link);
						if (mysql_num_rows($result) == 1)
							echo 'This user is in your friends list already <meta http-equiv="refresh" content="2; url=friends.php">';
						else
						{
							$query = "INSERT INTO `t_friends` (userid, friendid) VALUES ('".$_SESSION['uid']."', '".$_GET['id']."')";
							$result = mysql_query ($query, $link);
							if ($result)
								echo 'User added. <meta http-equiv="refresh" content="2; url=friends.php">';
						}
					}
					break;
			}
		?>
	</body>
</html>