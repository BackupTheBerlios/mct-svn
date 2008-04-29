<?php
/*
 * Created on 03.04.2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
	if(isset($_GET[posi]))
    {	
   		$calendar_language = implode($_GET[posi]);	
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
		<h2> Jürgen </h2>
      	<h4> 4AKDVK </h4>
      </div>
      <div id="sidebarrechts">
      	<h1>Bennersdorfer</h1>
      	<h2> Dominik </h2>
      	<h4> 4AKDVK </h4>
      </div>
      <div id="mitte">
      	<p>
      	<?php include "calendar.php"; ?>
      	</p>
      	<p>
      	<form action="index.php" method="post">
  	  		Name: <input type="text" name="name" size="20" maxlength="25"/>
 			Passwort: <input type="password" name="pass" size="20" maxlength="15"/>
 			<br/> 
   			<input type="submit" name="login" value="Login"/>
   	  	</form> 	
   	  	  </p> 
   	  	  
  		<form action="index.php" method="get">
       	Wollen sie die Sprache des Kalender ändern ?
      	Hier können Sie das tun 
      	<!-- "es","fr","ger","it","kr","nl","uk" -->
  		<select name="posi[]" size="1">
    		<option value="ger">Deutsch</option>
    		<option value="uk">Englisch</option>
    		<option value="fr">Französich</option>
    		<option value="it">Italienisch</option>
    		<option value="nl">Holländisch</option>
    		<option value="es">Spanisch</option>
    		<option value="kr">Koreanisch</option>
  		</select>
  		<br/>
  		<input type="submit" name="sprache" value="Sprache ändern"/>
     
      </p>
      </div>
  </div>
 	
  </form>
  </body>
</html>
