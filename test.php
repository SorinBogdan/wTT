<html>
	<head>
		<style type = "text/css">
			.p_n_1 {
				background-image: url('style/grass.png');
				width: 64px;
				height: 31px;
				display: inline-block;
				position: relative;
			}
			.p_n {
				background-image: url('style/grass.png');
				width: 64px;
				height: 31px;
				display: inline-block;
				position: relative;
				top: -15px;
			}
			.p_r {
				background-image: url('style/grass.png');
				width: 64px;
				height: 31px;
				display: inline-block;
				position: relative;
				top: -30px;
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
				for ($x = 1; $x <= 17; $x++)
				{
					$p [$y] [$x] ['t'] = "grass";
					$p [$y] [$x] ['o'] = "0";
				}
			for ($y = 1; $y<=100; $y++)
			{
				if ($y % 2 == 0)
					$a = "p_r";
				else if ($y == 1 && !($y%2))
					$a = "p_n_1";
				else
					$a = "p_n";
				for ($x = 1; $x <= 17; $x++)
				{
					echo '<div class = "'.$a.'"></div>';
				}
				echo '<br>';
			}
		?>
	</body>
</html>