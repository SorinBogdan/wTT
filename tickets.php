<?php include 'inc/config.php'; ?>
<html>
	<head>
	
	</head>
	<body>
		<?php
			switch ($_GET['action']) {
				case '':
					$query = "SELECT * FROM `t_maps` WHERE premium = '0' AND nrc < max";
					$result = mysql_query($query, $link);
					echo '<table border = 1>';
					echo '<tr><th>Name</th><th>Players</th><th>Size</th><th>Price</th><th>Buy</th>';
						$nrmaps = 0;
						while($row = mysql_fetch_array($result))
						{
							$query1 = "SELECT * FROM `t_tickets` WHERE userid = '".$_SESSION['uid']."' AND mapid = ".$row['id'];
							$result1 = mysql_query ($query1, $link);
							if (mysql_num_rows ($result1) == 0)
							{
								$nrmaps++;
								echo '<tr>';
									echo '<td>'.$row['name'].'</td>';
									echo '<td>'.$row['nrc'].'/'.$row['max'].'</td>';
									echo '<td>'.$row['x'].'/'.$row['y'].'</td>';
									echo '<td>'.$row['price'].'</td>';
									echo '<td><a href = "tickets.php?action=buy&id='.$row['id'].'">Buy</a></td>';
							}
						}
					if ($nrmaps == 0)
								echo '<tr><td colspan = 5><center>Sorry, not available maps found for your level</center></td>';
					echo '</table>';
					break;
				case 'buy':
					if (!isset($_GET['id']))
						die ('Please enter a map id');
					elseif (mysql_num_rows(mysql_query("SELECT * FROM `t_tickets` WHERE userid = '".$_SESSION['uid']."' AND mapid = ".$_GET['id'], $link)))
						die ('You bought this map already');
					$query = "SELECT * FROM `t_maps` WHERE id = ".$_GET['id'];
					$result = mysql_query($query, $link);
					$row = mysql_fetch_array($result);
					// Check if user has enough money to buy the ticket
					if($_SESSION['money'] >= $row['price']) // user has enough money
					{
						// pay for the ticket
						$query = "UPDATE `t_users` SET money = ".($_SESSION['money'] - $row['price'])." WHERE userid = '".$_SESSION['uid']."'";
						$result = mysql_query ($query, $link);
						$_SESSION['money'] = $_SESSION['money'] - $row['price'];
						// add ticket
						$query = "INSERT INTO `t_tickets` (userid, mapid) VALUES ('".$_SESSION['uid']."', '".$_GET['id']."');";
						$result = mysql_query($query, $link);
						echo 'You succesfuly bought this map';
						// update number of players
						mysql_query("UPDATE `t_maps` SET nrc = nrc+1 WHERE id = ".$row['id'], $link);
					}
					else //user does not have enough money
						echo 'Sorry, you don\'t have enough money to buy this map.';
			}
		?>
	</body>
</html>