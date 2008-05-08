<?php
/*
 * Created on 08.05.2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 include "vars_calendar.php";
	 /////////////////////////////////////////////
	//Print the calendar css code
	//
  echo "
		<style type=\"text/css\">
			a.cal_head
			{
				color: " . $head_link_color . ";
			}
			a.cal_head:hover
			{
				text-decoration: none;
			}
			.cal_head
			{
				background-color: " . $head_background_color . ";
				color:            " . $head_font_color . ";
				font-family:      " . $font_family . ";
				font-size:        " . $head_font_size . ";
				font-weight:      " . $head_font_weight . ";
				font-style:       " . $head_font_style . ";
			}
			.cal_days
			{
				background-color: " . $days_head_background_color . ";
				color:            " . $days_head_font_color . ";
				font-family:      " . $font_family . ";
				font-size:        " . $days_head_font_size . ";
				font-weight:      " . $days_head_font_weight . ";
				font-style:       " . $days_head_font_style . ";
			}
			.cal_content
			{
				background-color: " . $content_background_color . ";
				color:            " . $content_font_color . ";
				font-family:      " . $font_family . ";
				font-size:        " . $content_font_size . ";
				font-weight:      " . $content_font_weight . ";
				font-style:       " . $content_font_style . ";
			}
			.cal_today
			{
				background-color: " . $today_background_color . ";
				color:            " . $today_font_color . ";
				font-family:      " . $font_family . ";
				font-size:        " . $today_font_size . ";
				font-weight:      " . $today_font_weight . ";
				font-style:       " . $today_font_style . ";
			}
 			.cal_event, a.cal_event
			{
				background-color: " . $event_background_color . ";
				color:            " . $event_font_color . ";
				font-family:      " . $font_family . ";
				font-size:        " . $event_font_size . ";
				font-weight:      " . $event_font_weight . ";
				font-style:       " . $event_font_style . ";
			}			
			.cal_dayoff /*das ist ein TEST */
			{
				background-color: red;
				color:            black;
				font-family:      " . $font_family . ";
				font-size:        " . $days_head_font_size . ";
				font-weight:      " . $days_head_font_weight . ";
				font-style:       " . $days_head_font_style. ";
			}
		</style>
  ";
	//
	/////////////////////////////////////////////
?>
