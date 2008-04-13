<?php
/*
 * Created on 03.04.2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 ?>
 
 <html>
  <head>
    <title>Multifunktions-Kalender</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body style="background-color:lightblue"> 
      <div id="sidebarlinks">
		<h1>1999</h1>
      </div>
      <div id="sidebarrechts">
      	<h1>irgendwas</h1>
      </div>
      <div id="mitteoben">
      	<? include "calendar.php"; ?>
      </div>
      <div id="mitteunten">
      	Wollen sie die Sprache des Kalender ändern ?
      	Hier können Sie das tun 
      	<!-- "es","fr","ger","it","kr","nl","uk" -->
  		<select name="sprachen" size="5">
    		<option value="Deutsch">Deutsch</option>
    		<option value="Englisch">Englisch</option>
    		<option value="Französich">Französich</option>
    		<option value="Italienisch">Italienisch</option>
    		<option value="Holländisch">Holländisch</option>
    		<option value="Spanisch">Spanisch</option>
    		<option value="Koreanisch">Koreanisch</option>
  		</select>
  
      </div>
  </body>
</html>
