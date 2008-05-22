<?php
echo "<html>
				  <head>
				    <title>Multifunktions-Event-Kalender</title>
				    <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
				  </head>
				  <body>
				  <div id=\"wrapper\"> 
				      <div id=\"sidebarlinksuser\">
				      	<div id=\"userinfo\">
				      	Hallo"; echo $_SESSION["username"] ;
				      echo "</div>
				      </div>
				      <div id=\"sidebarrechts\">
				      </div>
				      <div id=\"mitte\">
				      <p>";
						include "usercalendar.php"; 
					      echo "</p>";
					      include "form_userevent.php";					
 				  	echo"</div><!-- mitte >
				  </div><!-- Wrapper -->
				  </body>
				</html>";
?>
