<?php include 'inc/config.php';?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style/map.css" />
	</head>
	<body>
		<?php
			$map = $_SESSION['map'];
			// gete info about the map
			$query1 = "SELECT * FROM `t_maps` WHERE name = '".$map."'";
			$result1 = mysql_query($query1, $link);
			if (!$result1)
				die ('Cannot find map');
			else
			$info = mysql_fetch_array($result1);
		?>
			
			<div class="main" style = "width: <?php echo $info['x']*40+$info['x']*16.5;?>px; height: <?php echo $info['y']*40+$info['y']*16.5?>;">
			<div class="map" style = "width: <?php echo $info['x']*40;?>px; height: <?php echo $info['y']*40?>;" >
		<?php
			// generate the map
			$query = "SELECT * FROM `t_".$map."`";
			$result = mysql_query ($query, $link);
			for($y = 1; $y <= $info['y']; $y++)
				for($x = 1; $x <= $info ['x'], $row = mysql_fetch_array($result); $x++)
				{
					echo'
						<div class="cell" style="cursor: pointer ;">
							<div class="content">
								<div class="content1">';
									if ($row['t'] == "tree")
									{
										echo '<img src="style/tree.png" /> ';
									}
					echo '
								</div>    
							</div>
						</div>
						';
				}
		?>
			</div>
			</div>
	</body>
</html>
