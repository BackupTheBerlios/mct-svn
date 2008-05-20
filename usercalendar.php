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
	$name_von_Session = 'pinter';//$_SESSION['username'];
		
	//Erklärung zu dem zeugs oben:
	//fopen(&language_file,"r")  Öffnet die Datei nur zum Lesen und positioniert den Dateizeiger auf den Anfang der Datei.
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

	$date_string = mktime(0,0,0,$month,1,$year); //The date string we need for some info
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
	//CSS-Code einbinden für den Calendar
	//
	include "calendar_css.php";
	//
	/////////////////////////////////////////////
	//show events in popup?
	//
	if (isset ($_GET['show_event'])){
    list ($year, $month, $day) = explode ("-", $_GET['event_date']);
    $query = "
      SELECT *
      FROM " . $event_table . "
      WHERE EventYear  = '" . $year . "'
      AND   EventMonth = '" . $month . "'
      AND   EventDay   = '" . $day . "'
      AND   EventBenutzer like '" . $name_von_Session ."'
      ORDER BY EventTime ASC
    ";

    /* connect to the database */
    $database_connection = mysql_connect ($server, $username, $password);
    mysql_select_db ($database, $database_connection);
    $result = mysql_query ($query) or die(mysql_error());

    /* initize the variabele color_alternated (boolean) */
    $color_alternated = false;

    /* header of the table */
    echo "<table width=\"100%\" border=\"" . $table_border . "\" cellpadding=\"" . $table_cellpadding . "\" cellspacing=\"" . $table_cellspacing . "\">";

    $date_string = mktime(0,0,0,$month,$day,$year);
    $month = sprintf("%01d",$month);

    echo "<tr><td align=\"center\" class=\"cal_head\" colspan=\"2\">".$day." " . $monthname[$month] . " ".$year."</td></tr>";

    /* loop through the results via a mysql_fetch_assoc () */
    while ($record = mysql_fetch_assoc ($result)){
      if ($color_alternated){
        $color_alternated = false;
        $background_color_row = $event_background_color;
      }
      else{
        $color_alternated = true;
        $background_color_row = $event_background_color2;
      }
      echo "<tr class=\"cal_event\">
              <td style=\"background-color:".$background_color_row."\" width=\"1\">" . $record['EventTime'] . "</td>
              <td style=\"background-color:".$background_color_row."\">" . nl2br($record['Event']) . "</td>
            </tr>";
    }
    /* close the table */
    echo "</table>";

    /* bring an exit so the script will terminate*/
    exit;
	}
	//
	/////////////////////////////////////////////
	
	/////////////////////////////////////////////
	//Print the calendar table header
	//
	echo "
		<script language=\"javascript\">
      function open_event(date_stamp){
        window.open(\"" . $usercalendar_script . "?show_event=true&event_date=\" + date_stamp, \"calendar_popup\",\"height=" . $event_popup_height . ",width=".$event_popup_width."\");
      }
		</script>
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

	////////////////////////////////////////////
	//Retrieve events for the current month + year
	//e-man : added 07 June 04
  if ($events_from_database)
  {
    $database_connection = mysql_connect ($server, $username, $password);
    mysql_select_db ($database, $database_connection);
    $result = mysql_query("
      SELECT *
      FROM " . $event_table . "
      WHERE
        EventYear = '" . $year . "'
      AND
        EventMonth = '" . $month . "'
      AND
      	EventBenutzer like '" .  $name_von_Session  ."'
    ");
    while ($record = mysql_fetch_assoc($result)){
      $event[$record['EventDay']] = $record;
    }
  }
	//


	/////////////////////////////////////////////
	//Loop all the days from the month
	//
	for( $i = 1; $i <= $total_days_in_month ; $i++)
	{
		$class = "cal_content";
		
		//TEST wegen FEIERTAG
	
		//date("j") liefert Tag des Monats ohne führende Nullen 1 bis 31
		//date("n")leifert Monatszahl, ohne führende Nullen 1 bis 12
		//date("Y")	Vierstellige Jahreszahl Beispiel: 1999 oder 2003
		//else{
		if( $i == date("j") && $month == date("n") && $year == date("Y") )
			$class = "cal_today";
			$current_position++;
		   /* is there any event on this day? Yes, create a link. No clear the (previous) string */
		$link_start = "";
		$link_end   = "";


    /* if there is an event do */
		if( isset($event[$i]) )
    {
      $link_start = "<a href=\"javascript:;\" class=\"cal_event\" onclick=\"javascript: open_event('".$year."-".$month."-".$i."');\">";
      $link_end   = "</a>";
      $class      = "cal_event";
    }

    /* for the event filter */
    /* e-man : added 07 June 04 */
    $date_stamp = $year."-".$month."-".sprintf( "%02d",$i);
    
		echo "<td align=\"center\" class=\"" . $class . "\">" . $link_start . $i . $link_end . "</td>";
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
	
	echo "</tr></table>";  // Close the table
?>