<?php /* SMARTSEARCHNS$Id: tasks.inc.php,v 1.1 2006/11/02 08:39:30 pedroix Exp $ */
/**
* tasks Class
*/
class tasks extends smartsearchns {
	var $table = "tasks";
	var $table_module	= "tasks";
	var $table_key = "task_id";
	var $table_link = "index.php?m=tasks&a=view&task_id=";
	var $table_title = "Tasks";
	var $table_orderby = "task_name";
	var $search_fields = array ("task_name","task_description","task_related_url","task_departments",
								"task_contacts","task_custom");
	var $display_fields = array ("task_name","task_description","task_related_url","task_departments",
								"task_contacts","task_custom");

	function ctasks (){
		return new tasks();
	}
}
?>
