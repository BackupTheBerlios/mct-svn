<?php

  include "functionsClasses.php";  //functionen Includieren
  
  // pr�fen ob Passwort und user name eingebebn wurd und obs richtig ist
  if (isset($_POST["userpass"]) and isset($_POST["username"]) and 
     $_POST["username"]!="") {
     session_register("username");				 // Userid in Session speichern
     $_SESSION['username'] = $_POST["username"]; 
     $name = $_SESSION['username'];
     UserDBConnect();
     if(UserDBCheck_user($_POST["username"],$_POST["userpass"]) == true) {
			//Beim ersten Pageload sind nur die schon vorhandne Events zum anzeigen
			//beim erneuten Pageload neue mit eintragen
			if(isset($POST["beschreibung"]) and isset($POST["jahr"]) and isset($POST["monat"])
			and isset($POST["tag"]) and isset($POST["zeit"]) and $_POST["beschreibung"]!="" and $_POST["jahr"]!="" 
			and $_POST["monat"]!="" and $_POST["tag"]!="" and $_POST["zeit"]!=""){
				//Neuen Event eintragen
				newEvent($POST["beschreibung"],$POST["jahr"],$POST["monat"],$POST["tag"],$_POST["zeit"]);
			}
			else{
				include "home_box.php";
			}
     }
   	 else {
			include "error_box.php";
     }
    }
   else{
   	//Calendar neu laden
   	inOrdnung($name);
   }
?>

