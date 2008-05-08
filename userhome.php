<?php
/*
 * Created on 08.05.2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  include "functionsClasses.php";
  if (isset($_POST["userpass"]) and isset($_POST["username"]) and 
     $_POST["username"]!="") {
     UserDBConnect();
     if(UserDBCheck_user($_POST["username"],$_POST["userpass"]) == true) {
	  	 // Das Login-Formular wurde schon submitted, die Logindaten aus dem Formular
	  	 // verifzieren und in der Session speichern
	     session_register("username");			//User name in der Session Speichern
	     $_SESSION['username'] = $_POST["username"];
	     echo "<html>
				  <head>
				    <title>Multifunktions-Kalender</title>
				    <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
				  </head>
				  <body>
				  <div id=\"wrapper\"> 
				      <div id=\"sidebarlinksuser\">
				      	<div id=\"userinfo\">
				      	Hallo" ; $_SESSION['username'] ;
				      echo "</div>
				      </div>
				      <div id=\"sidebarrechts\">
				      </div>
				      <div id=\"mitte\">
				      <p>";
						include "usercalendar.php"; 
				      echo "
				      </p>
				      <div id=\"userevents\">
				      	Hier kommt eine Eingabemaske hin
				      </div>
				  	</div>
				  </div>
				  </body>
				</html>";
     }
   } 
   else {
   	echo "<h1> ERROR </h1> <br>" .
   			"Bitte eingaben prüfen";
   } 
?>

