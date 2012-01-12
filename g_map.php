<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        
        <style type="text/css">
            body {
                background-color: #000 ;
            }
            
            div.cell {
                width: 40px ;
                height: 40px ;
                float: left ;
                background: url(style/grass.png) ;
            }
            
            div.map {

                -webkit-transform:rotate(45deg);
                -o-transform:rotate(45deg);
                -moz-transform:rotate(45deg);
                -ms-transform:rotate(45deg);
                margin: 0px auto;
            }
            
            div.main {

                -webkit-transform:rotateX(60deg);
                -o-transform:rotateX(60deg);
                -moz-transform:rotateX(60deg);
                -ms-transform:rotateX(60deg);
                margin: 0px auto;
            }
            
            div.content {
                width: 20px ;
                height: 20px ;
                -webkit-transform:rotate(135deg);
                margin-left: 8px ;
                margin-top: 8px ;
                
            }
            
            div.content1 {
                -webkit-transform:rotate(180deg);
            }
            
            img {
                -webkit-transform:rotateX(0deg);
            }
            
        </style>
    </head>
    <body>
	<?php
		function probabilitate($sansa, $din = 100) {
			$random = mt_rand(1, $din);
			return $random <= $sansa;
		}
		if ($_SESSION['class'] != "admin")
			echo 'Sorry, you do not have acces to this page!';
		else if ($_SESSION['class'] == "admin")
		
	?>
        <br/><br/><br/><br/><br/><br/><br/>
        <div class="main">
        <div class="map" onclick = "zoom()">
        <?php
            for($y = 1; $y <= 25; $y++)
            {
                for($x = 1; $x <= 25; $x++)
                   {
						$random = rand(1, 3);
						echo'
                            <div class="cell" style="cursor: pointer ;">
                                <div class="content">
                                    <div class="content1">';
										if (probabilitate(20))
											echo '<img src="style/tree.png" /> ';
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
        
    </body>
</html>
