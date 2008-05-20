<?php

echo "<div id=\"userevents\">
    	<h3> Hier können Sie Ihre Events eintragen!</h3> 
    	<form method=post action=\"userhome.php\">  
            <table>
              <tr>
                <td><label>Event beschreibung:</label></td>
                <td><input name=\"beschreibung\" type=\"text\"></td>
                <td><label>Bsp: Party bei Huber </label></td>
              </tr>
              <tr>
                <td><label>Jahr des Events: </label></td>
                <td><input name=\"jahr\" type=\"text\" ></td>
                <td><label>Format: yyyy --> 2008</label></td>		
              </tr>
              <tr>
                <td><label>Monat des Events: </label></td>
                <td><input name=\"monat\" type=\"text\" ></td>
                <td><label>Format: mm --> 01 bis 12</label></td>		
              </tr>
              <tr>
                <td><label>Tag des Events: </label></td>
                <td><input name=\"tag\" type=\"text\" ></td>
                <td><label>Format: dd --> 01 bis 31</label></td>		
              </tr>
              <tr>
                <td><label>Zeit des Events: </label></td>
                <td><input name=\"zeit\" type=\"text\"></td>
                <td><label>Format: 24:60:60 --> 00:00:00</label></td>		
              </tr>
            </table>
            <input name=\"eintragen\" type=\"submit\" id=\"eintrag\" value=\"Event eintragen\">
          </form>		
	 </div><!-- userevents -->";
?>
