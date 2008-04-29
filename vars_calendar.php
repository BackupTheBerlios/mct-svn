<?php
/*
 * Created on 28.04.2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
	/////////////////////////////////////////////
	//Declare some variables
	//
	$calendar_script          = "calendar.php"; //The location of this script
	$calendar_language        = "ger";       //The extension of the calendar language file.
	//mögliche Sprachen "es","fr","ger","it","kr","nl","uk"
	
	$content_background_color = "#EEEEEE";   //Background color of the column
	$content_font_color       = "#000000";   //The font color
	$content_font_size        = 22;          //Font-size in pixels
	$content_font_style       = "normal";    //Set to italic or normal
	$content_font_weight      = "normal";    //Set to bold or normal

	$today_background_color   = "white";   //Background color of the column
	$today_font_color         = "green";   //The font color
	$today_font_size          = 22;          //Font-size in pixels
	$today_font_style         = "normal";    //Set to italic or normal
	$today_font_weight        = "bold";      //Set to bold or normal

	$event_background_color   = "#DDDDDD";   //Background color of the column
	$event_background_color2  = "#EEEEEE";   //Background color of the 2nd column (event popup)
	$event_font_color         = "#000000";   //The font color
	$event_font_size          = 22;          //Font-size in pixels
	$event_font_style         = "normal";    //Set to italic or normal
	$event_font_weight        = "bold";      //Set to bold or normal
  	$event_popup_width        = "250";       //Width  of the popup for the events
  	$event_popup_height       = "350";       //Height of the popup for the events
	
	$head_background_color    = "#DDDDDD";   //Background color of the column
	$head_font_color          = "green";   //The font color
	$head_font_size           = 24;          //Font-size in pixels
	$head_font_style          = "normal";    //Set to italic or normal
	$head_font_weight         = "bold";      //Set to bold or normal
	
	//CSS OPTIONS FOR WEEK DAYS
	$days_head_background_color = "#DDDDDD";   //Background color of the column
	$days_head_font_color       = "gray";   //The font color
	$days_head_font_size        = 20;          //Font-size in pixels
	$days_head_font_style       = "normal";    //Set to italic or normal
	$days_head_font_weight      = "bold";      //Set to bold or normal
	
	$table_border             = 0;           //The border of the table
	$table_cellspacing        = 1;           //Cellspacing of the table
	$table_cellpadding        = 2;           //Cellpadding of the table
	$table_width              = '';          //Table width in pixels or %'s
	$table_height             = '';          //Table height in pixels or %'s
	$head_link_color          = "green";    //The color of the link for previous/next month
	$font_family = "Verdana";
	
	$events_from_database     = false;        //Set to true if you want to retrieve events
	$database                 = "kalender";  //Name of the database within the event_table
  	$server                   = "localhost"; //Name of the server
  	$username                 = "root";  //MySQL username
  	$password                 = "********";  //MySQL password
  	$event_table              = "calendar_events"; //Name of the calendar_events
	//
	/////////////////////////////////////////////
	
	 	/////////////////////////////////////////////
	//Load the language into usable variables

	$language_file  = "Language/calendar." . $calendar_language;	    //Language file into variable
	$fd             = fopen( $language_file, "r" );             
	$fd             = fread( $fd, filesize( $language_file ) ); //Read the opened file
	$language_array = explode( "\n" , $fd );                    //Put file info into array 
	$dayname   = array_slice($language_array,0,7); //The names of the days
	$monthname = array_slice($language_array,7);   //The rest of the language file are the monthnames
	
	//Erklärung zu dem zeugs oben:
	//fopen(&language_file,"r")  Öffnet die Datei nur zum Lesen und positioniert den Dateizeiger auf den Anfang der Datei.
	//fread( $fd, filesize( $language_file ) ) auslesen in die variable
	//explode( "\n" , $fd ); Teilt einen String anhand einer Zeichenkette "/n" ist absatz 
	//array_slice($language_array,0,7); Extrahiert einen Ausschnitt eines Arrays von x bis y
	// 0-7 deshalb da die language file  = So/n Mo/n Di/n Mi/n Do/n Fr/n Sa/n ... aufgebaut ist nacher kommen die monatsnamen
	//array_slice($language_array,7) ab der 8 Stelle Stelle alles
	/////////////////////////////////////////////
?>
