<?php
include "functionsClasses.php";
 /*
  * Namen der Input Felder:
  * 		 reg_username  --> gewünschter username
  * 		 reg_password  --> gewünschtes passwort
  * 		 reg_password2 --> gewünschtes passwort (wiederhohlungseingabe)
  * 		 reg_email	   --> E-Mail zu der bestätigung kommt und Regesitriert
  * 
  */
  
  //Variablen
  $username;
  $pwd;
  $pwd2;
  $email;
  
  //schau nach Formular komplett ausgefüllt wurde (beim laden) 
  if(isset($_POST["reg_username"]) and isset($_POST["reg_password"])
  	 and isset($_POST["reg_password2"]) and isset($_POST["reg_email"])
  	 and $_POST["reg_username"]!="" and $_POST["reg_password"]!="" and $_POST["reg_password2"]!=""
  	 and $_POST["reg_email"]!="") {
		//alles ausgefüllt dann
  		//Variablen füllen
  		$username = $_POST["reg_username"];
  		$pwd = $_POST["reg_password"];
  		$pwd2 = $_POST["reg_password2"];
  		$email = $_POST["reg_email"];
  		//nun schau ob es den user schon gibt
  		UserDBConnect(); //datenbank connect
  		if(IsNamefree($username)){
  			//username ist frei noch schon ob es die Mail schon gibt
  			//wir lassen pro Mail nur einen Nutzer zu
  			if(IsMailFree($email)) {
  				//Bis jetzt alles in ordnung neuen Benutzer hinzufügen (Mail und Name ist frei)
  				//jetzt noch die Passwort eingaben Prüfen (müssen beiden das gleiche sein)
  				if($pwd != $pwd2) {
  					echo "Die eingebenen Passwörter stimmen nicht überein!" .
  						"<br/><a href=\"register.php\"> nochmal probieren </a> ";
  				}
  				else{
  					//Jetzt passt endlich alles :-)
  					register($username, $pwd, $email);
  					sendMail($username, $pwd, $email);
  					echo "Sie sind nun Registriert und können das System im vollen Umfang nutzen.".
  						"Zusätzlich bekommen sie noch eine Bestätigungsmail mit ihren Daten".
  						"<a href=\"#\" onclick=\"javascript:window.close()\"> Schließen </a>";
  				}
  			}//if zu
  			else{
  				echo "Nur ein User Pro Mail".
  				"<br/><a href=\"register.php\"> nochmal probieren </a> ";
  			}//else zu
  		}//inneres if zu
  		else{
  			//Name ist schon besetzt
  			echo "Sorry dieser Username existiert schon :-( !".
  			"<br/><a href=\"register.php\"> nochmal probieren </a> ";
  		} 	//else zu	
  }//äusseres if zu
  
  else {
  	//wird beim pageload geladen
  	echo "
<html>
	<head><title>Registrierung</title></head>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
	<script language=\"JavaScript\">
<!--
function checkInput() 
{ 					
	if(document.register.reg_username.value == \"\" || document.register.reg_password.value == \"\" ||
		document.register.reg_password2.value == \"\" || document.register.reg_email.value == \"\") 
	{ 
		document.getElementById(11).style.display = \"block\";	// Hinweis einblenden
		document.getElementById(12).style.display = \"none\";	// Submit-Button ausblenden
	} 
	else
	{ 
		document.getElementById(11).style.display = \"none\";		// Hinweis ausblenden
		document.getElementById(12).style.display = \"block\";	// Submit-Button einblenden
	} 
}
 
//--> 
</script>
</head>
<body>
 		<h1>Registrierung</h1>
 		<Strong>Bitte geben Sie eine korrekte Emailadresse ein!<br>
 		Sie bekommen eine Bestätigung zugesenden wenn die Registrierung erfolgreich war
 		</Strong>
 		<p>
 		<form name=\"register\" method=post action=\"register.php\">
	 		<table style=\"width:100%; margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; border-color:black; \">
		 		<tr> <td width=\"33%\" >*&nbsp;Gewünschter Username</td>
		 		<td ><input type=\"text\" name=\"reg_username\"  onkeyup=\"checkInput())\" value=\"\" size=\"15\" maxlength=\"15\" >&nbsp;(max. 15 Zeichen)</td>
		 		</tr>
		 		<tr><td width=\"33%\">*&nbsp;Gewünschtes Passwort</td>
		 		<td><input type=\"password\" name=\"reg_password\"  onkeyup=\"checkInput()\" value=\"\" size=\"15\" maxlength=\"15\">&nbsp;(max. 15 Zeichen)</td>
		 		</tr>
		 		<tr><td width=\"33%\">*&nbsp;Passwort wiederholen</td>
		 		<td ><input type=\"password\" name=\"reg_password2\" onkeyup=\"checkInput()\" value=\"\" size=\"15\" maxlength=\"15\" >&nbsp;(max. 15 Zeichen)</td> 
		 		</tr>
		 		<tr><td width=\"33%\">*&nbsp;Deine Emailadresse</td>.
		 		<td ><input type=\"text\" name=\"reg_email\" onkeyup=\"checkInput()\" value=\"\" size=\"15\" maxlength=\"255\" >&nbsp;(max. 255 Zeichen)</td>
		 		</tr>
		 		<tr><td width=\"25%\" >&nbsp;</td>
		 		<td align=\"right\"></td>
		 		</tr>
		 		<tr><td>
				<!-- Wenn Felder nicht ausgefüllt -->
				<div id=\"11\" style=\"display: box; color: red;\"> 
					Bitte f&uuml;llen Sie alle Felder aus!
				</div> 
				</td></tr>  
				<!-- Wenn Felder ausgefüllt -->	 		
		 		<tr><td><input type=\"submit\" name=\"registrieren\" id=\"12\" value=\"Registrieren\" style=\"display: none\">
		 		</td></tr> 
	 		</table>
 		</form>
 		</p>
 	</body>
 </html>";
  }//else zu
 ?>
