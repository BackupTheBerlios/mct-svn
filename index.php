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
      	$_SESSION['sprache'] = $calendar_language;   //Sprach file in der Session gespeichert -für Persöhnlichen Kalendar
   	}
 ?>
 <html>
  <head>
    <title>Multifunktions-Kalender</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript">
	<!--
	function popup(){
	window.open("register.php","Registrieren","width=550,hight=550");
	}
	//-->
</script>
  </head>
  <body>
  <div id="wrapper"> 
      <div id="sidebarlinks">
		<h1>Pinter</h1>
		<h2> Jürgen </h2>
      	<h4> 4AKDVK </h4>
      	<h5> 2007/08 </h5> 
      </div>
      <div id="sidebarrechts">
      	<h1>Bennersdorfer</h1>
      	<h2> Dominik </h2>
      	<h4> 4AKDVK </h4>
      	<h5> 2007/08 </h5> 
      </div>
      <div id="mitte">
      	<p>
      	<br/>
   		<?php include "calendar.php"; ?>
      	</p>
      	<p>
      	<br/>	
  		<h3>Login:</h3>
		<?php include "login.php";	?>	
   	  	</p> 
   	  	noch nicht <a href="javascript:popup()">registriert</a> ?
   	  	<br>
   	  	<div id="bottombox">
	  		<form action="index.php" method="get">
		       	Wollen sie die Sprache des Kalender ändern ?
		       	<img src="pics/aut.png">
  				<img src="pics/ger.png"> 	
  				<img src="pics/sui.png">
  				<img src="pics/uk.png">
  				<img src="pics/kor.png">
  				<img src="pics/nl.png">
  				<img src="pics/esp.png">
  				<img src="pics/ita.png">
  				<img src="pics/fr.png">
		       	<br>
		      	Hier können Sie das tun 
		      	<!-- "es","fr","ger","it","kr","nl","uk" -->
		  		<select name="posi[]" size="1">
		    		<option value="ger">Deutsch</option>
		    		<option value="uk">Englisch</option>
		    		<option value="fr">Französisch</option>
		    		<option value="it">Italienisch</option>
		    		<option value="nl">Holländisch</option>
		    		<option value="es">Spanisch</option>
		    		<option value="kr">Koreanisch</option>
		  		</select>
		  		<input type="submit" name="sprache" value="Sprache ändern"/>
	  		</form>	
  		</div><!-- Bottombox -->
  	</div> <!-- Mittebox -->
  </div> <!-- Wrapper Box-->
  </body>
</html>
