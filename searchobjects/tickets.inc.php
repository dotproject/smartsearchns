<?php /* SMARTSEARCHNS$Id: tickets.inc.php,v 1.1 2006/11/02 08:39:30 pedroix Exp $ */
/**
* tickets Class
*/
class tickets extends smartsearchns {
	var $table = "tickets";
	var $table_module	= "ticketsmith";
	var $table_key = "ticket";
	var $table_link = "index.php?m=ticketsmith&a=view&ticket=";
	var $table_title = "Tickets";
	var $table_orderby = "subject";
	var $search_fields = array ("author","recipient","subject","type","cc","body","signature");
	var $display_fields = array ("author","recipient","subject","type","cc","body","signature");

	function ctickets (){
		return new tickets();
	}
}
?>
