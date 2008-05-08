<?php
  // login.php
  
  // ==================================================================
  // Login des Anwenders. 
  // To do: prüfen der Userid gegen Usertabelle, verwenden der Userid für 
  //        Kommunikation mit der Datenbank etc.
  // ==================================================================
  // ----------- ist der Benutzer bereits angemeldet? -----------
  if (IsLoggedIn() == true) {	 						// ja, bereits angemeldet
  }
  
  else {
      // Das Login Formular muss erst angezeit werden ...	
      echo '<form method=post action="userhome.php">  
            <table>
              <tr>
                <td><label>Benutzername:</label></td>
                <td><input name="username" type="text"></td>
              </tr>
              <tr>
                <td><label>Passwort: </label></td>
                <td><input name="userpass" type="password" id="userpass"></td>
              </tr>
            </table>
            <input name="login" type="submit" id="login" value="Einloggen">
          </form>'
          ;
    }
?> 

