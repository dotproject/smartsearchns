<?php /* SMARTSEARCHNS$Id: users.inc.php,v 1.1 2006/11/02 08:39:30 pedroix Exp $ */
/**
* users Class
*/
class users extends smartsearchns {
	var $table = "users";
	var $table_module	= "admin";
	var $table_key = "user_id";
	var $table_link = "index.php?m=admin&a=viewuser&user_id=";
	var $table_title = "Users";
	var $table_orderby = "user_username";
	var $search_fields = array ("user_username","user_signature");
	var $display_fields = array ("user_username","user_signature");

	function cusers (){
		return new users();
	}
}
?>
