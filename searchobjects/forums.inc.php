<?php /* SMARTSEARCHNS$Id: forums.php,v 1.0 2006/11/02 14:30:00 pedroix Exp $ */		
/**
* forums Class
*/
class forums extends smartsearchns {
	var $table = "forums";
	var $table_module	= "forums";
	var $table_key = "forum_id";
	var $table_link = "index.php?m=forums&a=viewer&forum_id=";
	var $table_title = "Forums";
	var $table_orderby = "forum_name";
	var $search_fields = array ("forum_name","forum_description");
	var $display_fields = array ("forum_name","forum_description");

	function cforums (){
		return new forums();
	}
}
?>
