<?php
	include "vars_calendar.php";
	
	/////////////////////////////////////////////
	//Load the language into usable variables

	$language_file  = "Language/calendar." . $calendar_language;	    //Language file into variable
	$fd             = fopen( $language_file, "r" );             
	$fd             = fread( $fd, filesize( $language_file ) ); //Read the opened file
	$language_array = explode( "\n" , $fd );                    //Put file info into array 
	$dayname   = array_slice($language_array,0,7); //The names of the days
	$monthname = array_slice($language_array,7);   //The rest of the language file are the monthnames
	$feiertag_file  = "Feiertag/feiertage.txt"; //Festlegen wo das File liegt mit den Feiertagen
	$fa             = fopen($feiertag_file,"r"); 
	$fa             = fread( $fa,filesize($feiertag_file)); 
	$feiertag_array = explode("\n", $fa); // Einlesen aller Zeilen der Datei, trennzeichen ist ein Leerzeichen
	$tagMonat = array();
	/*
	 *  Durchlaufen des $feiertag_array mit hilfe einer foreach-Schleife
	 *  mit dem Befehl array_push werden die nachfolgende Elemente die in $wert gespeichert werden
	 *  an das Ende des $tagMonat-Arrays geschreiben. 
	 *  Durch das explode wird der String beim 'Strichpunkt' getrennt! Mit dem Befehl
	 *  rtrim werden alle Leerzeichen am Ende des Strings gel�scht!
	 */
	foreach ($feiertag_array as $wert)
	{
		
		array_push($tagMonat, explode(";", rtrim($wert)));	
				
	}
		
	//Erkl�rung zu dem zeugs oben:
	//fopen(&language_file,"r")  �ffnet die Datei nur zum Lesen und positioniert den Dateizeiger auf den Anfang der Datei.
	//fread( $fd, filesize( $language_file ) ) auslesen in die variable
	//explode( "\n" , $fd ); Teilt einen String anhand einer Zeichenkette "/n" ist absatz 
	//array_slice($language_array,0,7); Extrahiert einen Ausschnitt eines Arrays von x bis y
	// 0-7 deshalb da die language file  = So/n Mo/n Di/n Mi/n Do/n Fr/n Sa/n ... aufgebaut ist nacher kommen die monatsnamen
	//array_slice($language_array,7) ab der 8 Stelle Stelle alles
	/////////////////////////////////////////////

	/////////////////////////////////////////////
	//Use the date to build up the calendar. From the Query_string or the current date
	//	
	if( isset( $_GET['date'] ) )
		list($month,$year) = explode("-",$_GET['date']);
	else
	{
		$month = date("m");
		$year  = date("Y");
	}
	//
	/////////////////////////////////////////////

	$date_string = mktime(0,0,0,$month,1,$year); //The date string we need for some info... saves space ^_^
	$day_start = date("w",$date_string);  //The number of the 1st day of the week

	/////////////////////////////////////////////
	//Filter the current $_GET['date'] from the QUERY_STRING
	//
	$QUERY_STRING = ereg_replace("&date=".$month."-".$year,"",$_SERVER['QUERY_STRING']);
	//
	/////////////////////////////////////////////
	

	/////////////////////////////////////////////
	//Calculate the previous/next month/year
	//
	if( $month < 12 )
	{
		$next_month = $month+1;
		$next_date = $next_month."-".$year;
	}
	else
	{
		$next_year = $year+1;
		$next_date = "1-".$next_year;
		$next_month = 1;
	}
	if( $month > 1 )
	{
		$previous_month = $month-1;
		$next_month    = $month+1;
		$previous_date = $previous_month."-".$year;
	}
	else
	{
		$previous_year = $year-1;
		$previous_date = "12-".$previous_year;
		$previous_month = 12;
	}
	//
	/////////////////////////////////////////////

	$table_caption_prev = $monthname[$previous_month-1] . " " . $year; // previous
	$table_caption      = $monthname[date("n",$date_string)-1] . " " . $year; // current
  	if ($next_month == 13){
    	$next_month = 1;
    	$year++;
  	}
	$table_caption_foll = $monthname[$next_month-1] . " " . $year;   // following
	
	
	/////////////////////////////////////////////
	//CSS-Code einbinden f�r den Calendar
	//
	include "calendar_css.php";
	//
	/////////////////////////////////////////////
	
	/////////////////////////////////////////////
	//Print the calendar table header
	//
	echo "
		<script language=\"javascript\">
      function open_event(date_stamp){
        window.open(\"" . $calendar_script . "?show_event=true&event_date=\" + date_stamp, \"calendar_popup\",\"height=" . $event_popup_height . ",width=".$event_popup_width."\");
      }
		</script>
		<p>
		<table border=\"" . $table_border . "\" cellpadding=\"" . $table_cellpadding . "\" cellspacing=\"" . $table_cellspacing . "\" style=\"height:" . $table_height . "\" width=\"" . $table_width . "\">
			<tr>
				<td align=\"center\" class=\"cal_head\"><a class=\"cal_head\" href=\"" . $_SERVER['PHP_SELF'] . "?" . $QUERY_STRING . "&amp;date=" .
                $previous_date . "\" title=\"" . $table_caption_prev . "\">&laquo;</a></td>
				<td align=\"center\" class=\"cal_head\" colspan=\"5\">" . $table_caption . "</td>
				<td align=\"center\" class=\"cal_head\"><a class=\"cal_head\" href=\"" . $_SERVER['PHP_SELF'] . "?" . $QUERY_STRING . "&amp;date=" .
                $next_date . "\" title=\"" . $table_caption_foll . "\">&raquo;</a></td>
			</tr>
			<tr>
				<td class=\"cal_days\">".$dayname[0]."</td>
				<td class=\"cal_days\">".$dayname[1]."</td>
				<td class=\"cal_days\">".$dayname[2]."</td>
				<td class=\"cal_days\">".$dayname[3]."</td>
				<td class=\"cal_days\">".$dayname[4]."</td>
				<td class=\"cal_days\">".$dayname[5]."</td>
				<td class=\"cal_days\">".$dayname[6]."</td>
			</tr><tr>
			";
	//
	/////////////////////////////////////////////
	
	/////////////////////////////////////////////
	//The empty columns before the 1st day of the week
	//
	for( $i = 0 ; $i < $day_start; $i++ )
	{
		echo "<td class=\"cal_content\">&nbsp;</td>";
	}
	//
	/////////////////////////////////////////////
	
	$current_position = $day_start; //The current (column) position of the current day from the loop
	$total_days_in_month = date("t",$date_string); //The total days in the month for the end of the loop

	/////////////////////////////////////////////
	//Loop all the days from the month
	//
	for( $i = 1; $i <= $total_days_in_month ; $i++)
	{
		$class = "cal_content";
		
		//TEST wegen FEIERTAG
	
		//date("j") liefert Tag des Monats ohne f�hrende Nullen 1 bis 31
		//date("n")leifert Monatszahl, ohne f�hrende Nullen 1 bis 12
		//date("Y")	Vierstellige Jahreszahl Beispiel: 1999 oder 2003
		//else{
		if( $i == date("j") && $month == date("n") && $year == date("Y") )
			$class = "cal_today";
			$current_position++;
			$nodayoff = false;  //Variable stellt sicher das wenn ein Feiertag eingezeichnet wird der normale aufbau ausgesetzt wird
			/*
			 * Diese For-Schleife durchl�uft den Feiertags-Array und tr�gt den Feiertag
			 * rot ein!
			 */
			for( $arr = 0; $arr < count($tagMonat); $arr++)
			{
				
				
				if($i == $tagMonat[$arr][0])
				{ 
					if($month == $tagMonat[$arr][1]) {
						
						$class = "cal_dayoff";
						echo "<td align=\"center\" class=\"" . $class . "\">" . $link_start . $i . $link_end . "</td>";
						$class = "cal_today";
						$nodayoff = true;
					}
				}
				
			}
			// ist die Variable false(kein Feiertag eingetragen) wird ganz "normal"
			// der Kalender weiter aufgebaut!
			if(!$nodayoff)
			{
				echo "<td align=\"center\" class=\"" . $class . "\">" . $link_start . $i . $link_end . "</td>";
				if( $current_position == 7 )
				{
					echo "</tr><tr>\n";
					$current_position = 0;
				}
			}
			if( $current_position == 7 )
			{
					echo "</tr><tr>\n";
					$current_position = 0;
			}
		
	}
	//
	/////////////////////////////////////////////
	
	$end_day = 7-$current_position; //There are 
	
	/////////////////////////////////////////////
	//Fill the last columns
	//	
	for( $i = 0 ; $i < $end_day ; $i++ )
		echo "<td class=\"cal_content\"></td>\n";
	//
	/////////////////////////////////////////////
	
	echo "</tr></table></p>";  // Close the table
?>