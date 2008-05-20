<?php

/*
 * Created on 08.05.2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  include "functionsClasses.php";
  if (isset($_POST["userpass"]) and isset($_POST["username"]) and 
     $_POST["username"]!="") {
     $name = $_POST["username"];
     UserDBConnect();
     if(UserDBCheck_user($_POST["username"],$_POST["userpass"]) == true) {
			inOrdnung($name);
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

