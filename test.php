<html>
	<head>
		<style type = "text/css">
			body {
				white-space:nowrap;
			}
			div {
				background-image: url('style/grass.png');
				width: 64px;
				height: 31px;
				display: inline-block;
				position: relative;
			}
			.p_n {
			}
			.p_r {
				left: 31px;
			}
		</style>
	</head>
	<body>
		<?php
			/*
			 * Map generator
			*/
			//include 'inc/config.php';
			
			// p [y] [x] ['t'] ['o']
			
			$p = array();
			for ($y = 1; $y<=100; $y++)
				for ($x = 1; $x <= 100; $x++)
				{
					$p [$y] [$x] ['t'] = "grass";
					$p [$y] [$x] ['o'] = "0";
				}
			for ($y = 1; $y<=100; $y++)
			{
				if ($y % 2 == 0)
					$a = "p_r";
				else
					$a = "p_n";
				for ($x = 1; $x <= 100; $x++)
				{
					echo '<div class = "'.$a.'" style = "top: -'.($y*15).'px; left: '.($y*31).'px;"></div>';
				}
				echo '<br>';
			}
		?>
	</body>
</html>