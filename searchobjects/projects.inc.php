<?php /* SMARTSEARCHNS$Id: projects.inc.php,v 1.1 2006/11/02 08:39:30 pedroix Exp $ */
/**
* projects Class
*/
class projects extends smartsearchns {
	var $table = "projects";
	var $table_module	= "projects";
	var $table_key = "project_id";
	var $table_link = "index.php?m=projects&a=view&project_id=";
	var $table_title = "Projects";
	var $table_orderby = "project_name";
	var $search_fields  = array ("project_name","project_short_name","project_description","project_url","project_demo_url");
	var $display_fields = array ("project_name","project_short_name","project_description","project_url","project_demo_url");

	function cprojects (){
		return new projects();
	}
}
?>
