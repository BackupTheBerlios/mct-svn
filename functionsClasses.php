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
	
  /**
   * Session löschen wenn sich der Userabmeldet
   */
  function f_abmelden() {
    session_unregister("userpass"); //Variablen aus der Session löschen
    session_unregister("username");
    session_destroy();   //Session verwerfen -sie hat es nie gegeben (Aufräumen)
  }
 
 /**
  * Trennt die verbindung zur Datenbank
  */
  function DbDisconnect() {
  	$con= mysql_connect('localhost','root','') or die(mysql_error()); //benutzer und passwort
  	mysql_close($con);	
  } 
  /**
   * Stellt die verbindung zu der Datenbank her
   */
  function UserDBConnect() {
    $con= mysql_connect('localhost','root','') or die(mysql_error()); //benutzer und passwort
    mysql_select_db('projektdbsys',$con) or die(mysql_error()); //datenbankname selektieren
}

/**
 * Prüft ob der User(name und Passwort) in der Datenbank vorhanden ist
 * Per Parameter kommen Username und passwort
 * wenn ja --> true falls nein --> false
 */
function UserDBCheck_user($name, $pass){
    $sql="SELECT BenutzerName,BenutzerPasswort 
    FROM benutzer".
    " WHERE BenutzerName='".$name."' AND BenutzerPasswort='".$pass."';";
    
    $result= mysql_query($sql) or die(mysql_error());
	if ( mysql_num_rows($result)==1)
   	{
        return true;
    }
    else{
	    return false;    
	}
}

function Error() {
	   	echo "<html>
			<head>
				<title>Multifunktions-Kalender</title>
				 <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
			 </head>
			 <body>
			 		<h1> ERROR </h1> <br>
   			 		Bitte Eingaben prüfen!
   			 		<a href=\"index.php\">zurück</a>
   			</body>
   			</html>";
}	

function inOrdnung($name) {
		  	 // Das Login-Formular wurde schon submitted, die Logindaten aus dem Formular
	  	 // verifzieren und in der Session speichern
	     session_register("username");			//User name in der Session Speichern
	     $_SESSION['username'] = $name;
	     echo "<html>
				  <head>
				    <title>Multifunktions-Kalender</title>
				    <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
				  </head>
				  <body>
				  <div id=\"wrapper\"> 
				      <div id=\"sidebarlinksuser\">
				      	<div id=\"userinfo\">
				      	Hallo " , $_SESSION['username'] , " !"  ;
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

/**
 * Prüft ob der Name frei ist der per Parameter übergeben wird
 */
function IsNamefree($name){
    $sql="SELECT BenutzerName FROM benutzer WHERE BenutzerName='".$name."'";   
    $result= mysql_query($sql) or die(mysql_error());
	if ( mysql_num_rows($result)==0)	{
        return true;
    }
    else {
	    return false;    
	}
}

/**
 * Prüft ob die Mail Adresse verüfgbar ist die per Paramater übergeben wird
 */
function IsMailFree($email){
    $sql="SELECT BenutzerEMail FROM benutzer WHERE BenutzerEMail='".$email."'";   
    $result= mysql_query($sql) or die(mysql_error());
	if ( mysql_num_rows($result)==0)	{
        return true;
    }
    else {
	    return false;    
	}
}

/**
 * Benutzer in der Datenbank registrieren
 */
function register($name,$pwd,$email)
{
//verbindung herstellen
$con= mysql_connect('localhost','root','') or die(mysql_error());
if (!$con) {
  die('Could not connect: ' . mysql_error());  //Großes Problem :) 
 }
mysql_select_db("projektdbsys", $con);
mysql_query("INSERT INTO benutzer (BenutzerName, BenutzerPasswort, BenutzerEMail) 
VALUES ('$name', '$pwd', '$email')");
mysql_close($con);
}

function sendMail($name,$pwd,$email)
{
  require('class.phpmailer.php');
  $mail = new PHPMailer();
  $mail->IsSMTP(); 				//Versand über SMTP festlegen
  $mail->Host = "mail.gmx.at"; //SMTP-Server setzen
  
  //Viele SMTP-Server verlangen zwischenzeitlich eine Authentifizierung.
  //Diese Methode wird auch als "SMTP Auth" bezeichnet. 
  //Dabei muss zum Versand von Emails ein Benutzername und in Passwort übergeben werden.
  //Die entsprechenden Befehle hierfür lauten wir folgt:
  $mail->SMTPAuth = true;     				//Authentifizierung aktivieren
  $mail->Username = "Sparky2000@gmx.at";  	// SMTP Benutzername
  $mail->Password = "southpark";			// SMTP Passwort
  
  //E-Mail (Kopf)basteln
  $mail->From = "Sparky2000@gmx.at";  		//Absenderadresse der Email setzen
  $mail->FromName = "Administration EventCalendar"; 	//Name des Abenders setzen
  $mail->AddAddress ("Dominik.Bennersdorfer@gmx.at");	//Empfängeradresse setzen
  $mail->Subject = "Registrierungsbestätigung";			//Betreff der Email setzen
  
  //Body E-Mail basteln
  $mail->Body = "Willkommen beim EventCalendar Service \n\n".
  				"Sie haben sich soeben mit diesen Daten erfolgreich registriert".
  				"  \nUsername: $name  \nPasswort: $pwd  \n\n" .
  				"Wir wünschen Viel Spass.";
	if(!$mail->Send()){
		   echo 'Message was not sent.';
		   echo 'Mailer error: ' . $mail->ErrorInfo;
	}
	else{
		   echo 'Message has been sent.';
	}
}
?>
