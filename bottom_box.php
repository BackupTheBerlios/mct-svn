<?php
echo "<div id=\"bottombox\">
	  		<form action=\"index.php\" method=\"get\">
		       	Wollen sie die Sprache des Kalender ändern ?
		       	<img src=\"pics/aut.png\">
  				<img src=\"pics/ger.png\"> 	
  				<img src=\"pics/sui.png\">
  				<img src=\"pics/uk.png\">
  				<img src=\"pics/kor.png\">
  				<img src=\"pics/nl.png\">
  				<img src=\"pics/esp.png\">
  				<img src=\"pics/ita.png\">
  				<img src=\"pics/fr.png\">
		       	<br>
		      	Hier können Sie das tun 
		      	<!-- \"es\",\"fr\",\"ger\",\"it\",\"kr\",\"nl\",\"uk\" -->
		  		<select name=\"posi[]\" size=\"1\">
		    		<option value=\"ger\">Deutsch</option>
		    		<option value=\"uk\">Englisch</option>
		    		<option value=\"fr\">Französisch</option>
		    		<option value=\"it\">Italienisch</option>
		    		<option value=\"nl\">Holländisch</option>
		    		<option value=\"es\">Spanisch</option>
		    		<option value=\"kr\">Koreanisch</option>
		  		</select>
		  		<input type=\"submit\" name=\"sprache\" value=\"Sprache ändern\"/>
	  		</form>	
  		</div><!-- Bottombox -->";
?>
