<?php /* SMARTSEARCHNS$Id: events.inc.php,v 1.1 2006/11/03 17:08:44 pedroix Exp $ */
/**
* events Class
*/
class events extends smartsearchns {
	var $table = "events";
	var $table_module	= "calendar";
	var $table_key = "event_id";
	var $table_extra = '';
	var $table_link = "index.php?m=calendar&a=view&event_id=";
	var $table_title = "Events";
	var $table_orderby = "event_start_date";
	var $search_fields = array ("event_title","event_description","event_start_date","event_end_date");
	var $display_fields = array ("event_title","event_description","event_start_date","event_end_date");

	function events (){
	      global $AppUI;
	      $this->table_extra = '(event_private = 0 or event_owner = '.$AppUI->user_id.')';	
	}

	function cevents (){
	      return new events();
	}
}
?>
