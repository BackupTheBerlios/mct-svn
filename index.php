<?php
/*
 * Created on 03.04.2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHP-Eclipse - PHP - Code Templates
 */
 include "session.php";
 include "functionsClasses.php";
 
    if(isset($_GET[posi]))
    {	
   		$calendar_language = implode($_GET[posi]);
   		session_register("sprache");				 // Passwort in Session speichern
      	$_SESSION['sprache'] = $calendar_language;   //Sprach file in der Session gespeichert -f�r Pers�hnlichen Kalendar
   	}
 ?>
 <html>
  <head>
    <title>Multifunktions-Kalender</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
  <div id="wrapper"> 
      <div id="sidebarlinks">
		<h1>Pinter</h1>
		<h2> J�rgen </h2>
      	<h4> 4AKDVK </h4>
      </div>
      <div id="sidebarrechts">
      	<h1>Bennersdorfer</h1>
      	<h2> Dominik </h2>
      	<h4> 4AKDVK </h4>
      </div>
      <div id="mitte">
      	<p>
      		<div align="center"><?php include "calendar.php"; ?></div>
      	</p>
      	<p>
		<?php include "login.php";	?>	
   	  	</p> 
  		<form action="index.php" method="get">
	       	Wollen sie die Sprache des Kalender �ndern ?
	      	Hier k�nnen Sie das tun 
	      	<!-- "es","fr","ger","it","kr","nl","uk" -->
	  		<select name="posi[]" size="1">
	    		<option value="ger">Deutsch</option>
	    		<option value="uk">Englisch</option>
	    		<option value="fr">Franz�sich</option>
	    		<option value="it">Italienisch</option>
	    		<option value="nl">Holl�ndisch</option>
	    		<option value="es">Spanisch</option>
	    		<option value="kr">Koreanisch</option>
	  		</select>
	  		<br/>
	  		<input type="submit" name="sprache" value="Sprache �ndern"/>
  		</form>
  	</div>
  </div>
  </body>
</html>
