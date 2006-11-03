<?php /* SMARTSEARCHNS$Id: events.php,v 1.0 2006/11/02 14:30:00 pedroix Exp $ */
/**
* events Class
*/
class events extends smartsearchns {
	var $table = "events";
	var $table_module	= "calendar";
	var $table_key = "event_id";
	var $table_link = "index.php?m=calendar&a=view&event_id=";
	var $table_title = "Events";
	var $table_orderby = "event_start_date";
	var $search_fields = array ("event_title","event_description","event_start_date","event_end_date");
	var $display_fields = array ("event_title","event_description","event_start_date","event_end_date");

	function cevents (){
		return new events();
	}
}
?>
