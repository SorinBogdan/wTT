<?php include 'inc/config.php'; ?>
<html>
<head>
	<link rel = "stylesheet" type = "text/css" href = "style/map.css">
</head>
<body style="margin: 13px 0px 0px 0px; background: #000;">
<?php
	$map = array();
	$query = "SELECT * FROM `t_users` WHERE userid = '".$_SESSION['uid']."'";
	$result = mysql_query ($query, $link);
	$row = mysql_fetch_array ($result);
	$_SESSION['mapname'] = $row ['map'];
	$query = "SELECT * FROM t_".$_SESSION['mapname'];
	$result = mysql_query($query, $link);
	while ($row = mysql_fetch_array($result))
	{
		$map[$row['y']][$row['x']] ['type'] = $row ['t'];
		//echo 'x: '.$row['x'].' y: '.$row['y'].', type: '.$map[$row['y']][$row['x']] ['type'].'<br>';
	}
?>
<?php
 /* Set the size of our target area */
 $range = 2;
 $nrp = 0;
 /* Build the pathfinding function */
 function pathfind($current_square_x, $current_square_y, $map, $steps, $target) {
 GLOBAL $nrp;
 /* Give the function a step limit.  We don't want to create an endless loop. */
 $max_steps = 100;

 /* Define the next steps */
 $next_steps[$current_square_y + 1]    [$current_square_x + 1]    = "";
 $next_steps[$current_square_y + 1]    [$current_square_x]     = "";
 $next_steps[$current_square_y + 1]    [$current_square_x - 1]    = "";
 $next_steps[$current_square_y - 1]    [$current_square_x + 1]    = "";
 $next_steps[$current_square_y - 1]    [$current_square_x]        = "";
 $next_steps[$current_square_y - 1]    [$current_square_x - 1]    = "";
 $next_steps[$current_square_y]        [$current_square_x + 1]    = "";
 $next_steps[$current_square_y]        [$current_square_x - 1]    = "";

 /* Do some math to find the distance from here (as the crow flies) to the target) */
 $query = "SELECT * FROM `t_maps` WHERE name = '".$_SESSION['mapname']."'";
 $result = mysql_query($query, $link);
 $row = mysql_fetch_array ($result);
 $height = $row ['y'];
 $width = $row ['x'];
 $minimum = sqrt(($width * $width) + ($height * $height));

 /* Find the closest tile */
 foreach($next_steps as $y_key => $y_value) {
 foreach($y_value as $x_key => $x_value) {
 if(
 isset($map[$y_key][$x_key]) &&
 $map[$y_key][$x_key] ['type'] != "tree" &&
 $map[$y_key][$x_key] ['type'] != "start" &&
 $steps < $max_steps
 ) {
 if($map[$y_key][$x_key] ['type'] != "traversed") {
 $width  = abs($x_key - $target['x']) + 1;
 $height = abs($y_key - $target['y']) + 1;
 $c = round(sqrt(($width * $width) + ($height * $height)),2);
 if($c < $minimum) {
 $minimum = $c;
 $lowest_distance_position = $x_key."x".$y_key;
 }
 }
 }
 }
 }

 /* Start the next calculation from the closest tile */
 $position = explode("x",$lowest_distance_position);

 if(
 isset($map[$position[1]][$position[0]]) &&
 !($position[0] == $target['x'] && $position[1] == $target['y'])
 ) {
 $map[$position[1]][$position[0]] ['type'] = "traversed";
 $nrp++;
 $path[$position[0]."x".$position[1]] =
 pathfind($position[0], $position[1], $map, $steps + 1, $target);

 if($path) {
 return $path;
 break;
 }
 }

 return array($position[0]."x".$position[1] => "target");
 break;
 }

 /* Convert the three based array to a step based array. */
 
 function build_path($path_array, $step_number) {
 if(sizeof($path_array) > 0 && is_array($path_array)) {
 foreach($path_array as $key => $value) {
 $this_path[$step_number] = $key;

 if(sizeof($path_array[$key]) > 0) {
 $built_path =
 array_merge(
 $this_path,
 build_path($path_array[$key], $step_number++)
 );
 return $built_path;
 }
 }
 } else {
 return array();
 }
 }
 $row1 = mysql_fetch_array (mysql_query("SELECT * FROM `t_maps` WHERE name = '".$_SESSION['mapname']."'", $link));
 /* Set the map size. */
 $map_size_x = $row1 ['x'];
 $map_size_y = $row1 ['y'];

 /* Build the blank map.
 for($y = 0; $y < $map_size_y; $y++) {
 for($x = 0; $x < $map_size_x; $x++) {
 $map[$y][$x] = "open";
 }
 }*/

 /*Set special sections of the map.
 $map[15][25] = "closed";
 $map[16][25] = "closed";
 $map[17][25] = "closed";
 $map[18][25] = "closed";
 $map[19][25] = "closed";
 $map[20][25] = "closed";*/
 $target['x'] = 6;
 $target['y'] = 6;
 $start['x'] = 2;
 $start['y'] = 2;

 $path = pathfind($start['x'], $start['y'], $map, 0, $target);
 $built_path = build_path($path, 1);

 /* Output the final map. */
// get info about the map
$query1 = "SELECT * FROM `t_maps` WHERE name = '".$_SESSION['mapname']."'";
$result11 = mysql_query($query1, $link);
if (!$result11)
	die ('Cannot find map');
else
	$info = mysql_fetch_array($result11);
?>
<br><br><br><br><br><br>
<div class="main" style = "width: <?php echo $info['x']*40+$info['x']*16.5;?>px; height: <?php echo $info['y']*40+$info['y']*16.5?>;">
<div class="map" style = "width: <?php echo $info['x']*40;?>px; height: <?php echo $info['y']*40?>;" >
<?php
 foreach($map as $y_key => $y_value) {
 foreach($y_value as $x_key => $x_value) {
 //echo "y_key: $y_key, y_value: $y_value, x_key: $x_key, x_value: $x_value <br>";
 /*if($x_value == "tree") {
 $background = "F99";
 } elseif ($x_value == "path") {
 $background = "9F9";
 } elseif ($x_key == $start['x'] && $y_key == $start['y']) {
 $background = "559";
 } elseif (
 $x_key < $target['x'] + $range &&
 $x_key > $target['x'] - $range &&
 $y_key < $target['y'] + $range &&
 $y_key > $target['y'] - $range
 ) {
 $background = "900";
 } elseif(in_array($x_key."x".$y_key,$built_path)) {
 $background = "353";
 } else {
 $background = "333";
 }
*/
						if ($map[$y_key] [$x_key] ['type']  == "traversed") {
										echo '<div class="cell1" style="cursor: pointer ;">';
						}
						else
							echo '<div class="cell" style="cursor: pointer ;">';
						echo '<div class="content">
								<div class="content1">';
									if ($map[$y_key] [$x_key] == "tree")
									{
										echo '<img src="style/tree.png" /> ';
									}
					echo '
								</div>    
							</div>
						</div>
						';
 }
 }

 echo "</div></div>";
 echo '<div style = "color: white;">Steps: '.$nrp.'</div>';
?>
</body>
</html>