<?php include 'inc/config.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
		<link rel="stylesheet" type="text/css" href="style/map.css" />
    </head>
    <body>
	<?php
		// limit access
		if ($_SESSION['rank'] != "admin")
			echo 'Sorry, you do not have acces to this page!';
		else if ($_SESSION['rank'] == "admin") // user is admin
		{
			switch ($_GET['p']) {
				 case '': ?>
					<form name = "g_det" action = "g_map.php?p=g_det" method = "POST">
					<div class = "g_main">
						<table>
							<tr>
								<td>Map name:</td>
								<td><input type = "text" maxlength = "15" name = "g_name"></td>
							<tr>
								<td>Price:</td>
								<td><input type = "text" maxlength = "5" name = "g_price"></td>
							<tr>
								<td>Max number of players:</td>
								<td><input type = "text" maxlength = "2" name = "g_max"></td>
							<tr>
								<td>Number of cols (x):</td>
								<td><input type = "text" maxlength = "3" name = "g_x"></td>
							<tr>
								<td>Number of rows (y):</td>
								<td><input type = "text" maxlength = "3" name = "g_y"></td>
							</tr>
								<td>Tree chance of generation:</td>
								<td><input type = "text" maxlength = "3" name = "g_chance"></td>
							
							<tr>
								<td><input type = "submit" value = "Generate"></td>
						</table>
					</div>
					</form>
				<?php 
				break;
				case 'g_det':
					$_SESSION['g_name'] = $_POST['g_name'];
					$_SESSION['g_price'] = $_POST['g_price'];
					$_SESSION['g_max'] = $_POST['g_max'];
					$_SESSION['g_x'] = $_POST['g_x'];
					$_SESSION['g_y'] = $_POST['g_y'];
					$_SESSION['g_chance'] = $_POST['g_chance'];
					echo 'Generating map ... <meta http-equiv="refresh" content="3; url=g_map.php?p=generate">';
					break;
					?>
				<?php case 'generate': ?>
					<div class = "g_madd">
						<table cellpadding = 10>
							<tr>
								<td><a href = "g_map.php?p=add">Add map to the database</a></td>
								<td><a href = "g_map.php?p=generate">Refresh map</a></td>
								<td><a href = "g_map.php">Start over</a></td>
						</table>
					</div>
					<br/><br/><br/><br/><br/><br/>
					
					<div class="main">
					<div class="map">
					<?php
						function probabilitate($sansa, $din = 100) {
							$random = mt_rand(1, $din);
							return $random <= $sansa;
						}
						/*GLOBAL $pt;
						$pt = array();*/
						for($y = 1; $y <= $_SESSION['g_y']; $y++)
						{
							for($x = 1; $x <= $_SESSION['g_x']; $x++)
							   {
									$pt [$y] [$x] ['t'] = "grass";
									$pt [$y] [$x] ['o'] = "0";
									echo'
										<div class="cell" style="cursor: pointer ;">
											<div class="content">
												<div class="content1">';
													if (probabilitate($_SESSION['g_chance']))
														{
															echo '<img src="style/tree.png" /> ';
															$pt [$y] [$x] ['t'] = "tree";
														}
									echo '
												</div>    
											</div>
										</div>
								';
								}
							echo'<br /><br />';
						}
					?>
					</div>
					</div>
					<?php
					// afisare array pentru test
						/*for($y = 1; $y <= $_SESSION['g_y']; $y++)
						{
							for($x = 1; $x <= $_SESSION['g_x']; $x++)
							   {
									echo "y: ".$y." x: ".$x." type: ".$pt [$y] [$x] ['t']." owner: ".$pt[$y][$x]['o']."<br>";
								}
						}*/
					?>
				<?php 
				break;
				case 'add':
					
					$query = "INSERT INTO `t_maps` (name, price, max, x, y) VALUES ('".$_SESSION['g_name']."', ".$_SESSION['g_price'].", ".$_SESSION['g_max'].", ".$_SESSION['g_x'].", ".$_SESSION['g_y'].")";
					$result = mysql_query($query, $link);
					if (!$result)
						die ('Cannot add map');
					$query = "
						CREATE TABLE `t_".$_SESSION['g_name']."` (
							y int(3),
							x int(3),
							t varchar(20),
							o varchar(20)
						)";
					$result = mysql_query($query, $link);
					if (!$result)
						die ('Table exists');
					for($y = 1; $y <= $_SESSION['g_y']; $y++)
					{
						for($x = 1; $x <= $_SESSION['g_x']; $x++)
							{
								$query = "INSERT INTO `t_".$_SESSION['g_name']."` (y, x, t, o) VALUES ('".$y."', '".$x."', '".$pt [$y] [$x] ['t']."', '".$pt [$y] [$x] ['o']."')";
								$result = mysql_query($query, $link);
							}
					}
					echo 'Done';
				break;
			}
		}
				?>
				
    </body>
</html>
