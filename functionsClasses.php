<?php
  // functionsClasses.php

  // ----------------------------------------------------------
  // Ist der Benutzer bereits angemeldet? 
  // ----------------------------------------------------------
  function IsLoggedIn() {  //function deklariert nur wird aber nicht ausgeführt
    if (isset($_SESSION["username"]) and isset($_SESSION["userpass"]) //isset schaut nach ob "username" vorhanden ist
         and $_SESSION["username"] !="" ) { //$_SESSION ist ein Systemarray
      	return(true);
    }
    else {
      return(false);	
    }
  }
  // ----------------------------------------------------------
  // Session: abmelden 
  // ----------------------------------------------------------
  function f_abmelden() {
    session_unregister("userpass"); //Variablen aus der Session löschen
    session_unregister("username");
    session_destroy();   //Session verwerfen -sie hat es nie gegeben (Aufräumen)
  }
  
  function UserDBConnect() {
    $con= mysql_connect('localhost','root','') or die(mysql_error()); //benutzer und passwort
    mysql_select_db('projektdbsys',$con) or die(mysql_error()); //datenbankname selektieren
}

function UserDBCheck_user($name, $pass){
    $sql="SELECT BenutzerName,BenutzerPasswort 
    FROM benutzer".
    " WHERE BenutzerName='".$name."' AND BenutzerPasswort='".$pass."';";
    
    $result= mysql_query($sql) or die(mysql_error());
	if ( mysql_num_rows($result)==1)
   	{
        return true;
    }
    else
	    return false;    
	}

function Error() {
	   	echo "<html>
			<head>
				<title>Multifunktions-Kalender</title>
				 <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
			 </head>
			 <body>
			 		<h1> ERROR </h1> <br>
   			 		Bitte eingaben prüfen 
   			 		<a href=\"index.php\">zurück</a>		
   			</body>
   			</html>";
}	
	

?>
