<?php

  include "functionsClasses.php";  //functionen Includieren
  
  // prüfen ob Passwort und user name eingebebn wurd und obs richtig ist
  if (isset($_POST["userpass"]) and isset($_POST["username"]) and 
     $_POST["username"]!="") {
     $name = $_POST["username"];
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
				inOrdnung($name);
			}
     }
   	 else {
			Error();
     }
    }
   else{
   	//Calendar neu laden
   	inOrdnung($name);
   }
?>

