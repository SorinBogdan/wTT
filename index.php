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
				<?php if ($_SESSION['logat']): ?>
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
					<?php if ($_SESSION['logat']): ?>
						<table>
							<tr>
								<td>Name:</td>
								<td><?php echo $_SESSION['name']; ?></td>
							<tr>
								<td>UiD:</td>
								<td><?php echo $_SESSION['uid']; ?></td>
							<tr>
								<td>Exp:</td>
								<td><?php echo $_SESSION['exp']; ?></td>
							<tr>
								<td>Lvl:</td>
								<td><?php echo $_SESSION['lvl']; ?></td>
							<tr>
								<td>Money:</td>
								<td><?php echo $_SESSION['money']; ?></td>
						</table>
					<?php else: ?>
						<p>You are not connected</p>
					<?php endif ?>
				</div>
				<div class = "content">
				
				</div>
			</div>
		</div>
	</body>
</html>