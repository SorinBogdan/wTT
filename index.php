<?php
	include 'inc/config.php';
	include 'inc/fb_get.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style/style.css" >
		<title>Home</title>
	</head>
	<body>
		<div class = "main">
			<div class = "header">
			
			</div>
			<div class = "menu">
				<a href = "index.php">Home</a> | 
				<a href = "faq.php">FAQ</a> | 
				<a href = "about.php">About</a> | 
				<?php if ($user): ?>
					<a href = "profile.php">Profile</a> | 
					<a href = "map.php">Map</a> | 
					<a href = "top.php">Top</a> | 
					<a href = "<?php echo $logoutUrl; ?>">Logout</a>
				<?php else: ?>
					<a href = "login.php">Login</a>
				<?php endif ?>
			</div>
			<div class = "container">
				<div class = "profile">
				
				</div>
				<div class = "content">
				
				</div>
			</div>
		</div>
	</body>
</html>