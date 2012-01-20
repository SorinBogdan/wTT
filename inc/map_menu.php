<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "./style/menu.css">
		<script type="text/javascript" src="inc/jquery.js"></script>
		<script type="text/javascript"> 
		$(document).ready(function(){
		$(".item").click(function(){
			$(".box").slideToggle("slow");
		  });
		});
		</script>
	</head>
	<body>
		<div class = "menu">
			<span class = "item">
				Build rail
			</span>
			<div class = "box">
				<form method = "POST" action = "build.php">
					<table border = "1">
						<tr>
							<td colspan = "4">Insert the start point and the end point of the rail</td>
						<tr>
							<td>&nbsp;</td>
							<td>From</td>
							<td>To</td>
						<tr>
							<td>X:</td>
							<td><input type = "text" maxlength = "2" size = "2" name = "start_x"></td>
							<td><input type = "text" maxlength = "2" size = "2" name = "start_y"></td>
						<tr>
							<td>Y:</td>
							<td><input type = "text" maxlength = "2" size = "2" name = "end_x"></td>
							<td><input type = "text" maxlength = "2" size = "2" name = "end_y"></td>
						<tr>
							<td colspan = "4"><input type = "submit" value = "Submit"></td>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>