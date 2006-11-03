<?php /* SMARTSEARCHNS$Id: smartsearchns.class.php,v 1.1 2006/11/02 08:39:30 pedroix Exp $ */
class smartsearchns  {

	var $table = null;
	var $table_module	= null;
	var $table_key = null;	// primary key in searched table
	var $table_key2 = null; // primary key in parent table
	var $table_link = null;	// first part of link
	var $table_link2 = null; // second part of link
	var $table_title = null;
	var $table_orderby = null;
	var $table_extra = null;
	var $search_fields = array ();
	var $display_fields = array ();
	var $keyword = null;
	var $keywords = null;
	var $tmppattern = "";
	var $display_val = "";
	var $search_options = null;
//	$search_options['display_all_flds']=="on"		display all fields
//	$search_options['display_all_flds']==""		display only first 2 fields from display_fields array
//	$search_opts['keywords']==array() 			array of searched keywords
//	$search_options['ignore_specchar']=="on"	enable  ignoring special eastern national characters / czech and slovak /
//	$search_options['ignore_specchar']==""		disable ignoring  special eastern national characters / czech and slovak /
//	$search_options['ignore_case']==""			match case	
//	$search_options['ignore_case']=="on"		ignore case 	/default/
//	$search_options['show_empty']==""			hide modules with empty results	/default/
//	$search_options['show_empty']=="on"			show modules with empty results	 	
//	$search_options['all_words']==""			any of the words	/default/
//	$search_options['all_words']=="on"			match all words	 	

	function smartsearchns(){
		return null;
	}
	
	function createlink() {
	$tmplink="";
	if (isset($this->table_link) && isset($this->table_key)) 
	$tmplink=$this->table_link.$records[$this->table_key];
	
	if (isset($this->table_link2) && isset($this->table_key2)) 
	$tmplink=$this->table_link.$records[$this->table_key].$this->table_link2.$records[$this->table_key2];
	
	return $tmplink;
	}
	function fetchResults(&$permissions, &$record_count){
		global $AppUI;
		$sql = $this->_buildQuery();
		$results = db_loadList($sql);
		if($results){
			$record_count += count($results);
			$outstring= "<tr><th><b>".$AppUI->_($this->table_title). ' (' . count($results) . ')'."</b></th></tr> \n";
			foreach($results as $records){
			    if ($permissions->checkModuleItem($this->table_module, "view", $records[$this->table_key])) {
// --MSy-				
					$ii=0;
					$display_val = "";
					foreach($this->display_fields as $fld){
						$ii++;
						if (!($this->search_options['display_all_flds']=="on") && ($ii>2))
							break;
						$display_val=$display_val." ".$records[$fld];
					}	
//--MSy-				
					$tmplink="";
					if (isset($this->table_link) && isset($this->table_key)) 
						$tmplink=$this->table_link.$records[$this->table_key];
					if (isset($this->table_link2) && isset($this->table_key2)) 
						$tmplink=$this->table_link.$records[$this->table_key].$this->table_link2.$records[$this->table_key2];
//--MSy--
					$outstring .= "<tr>";
    				$outstring .= "<td>";
    				$outstring .= "<a href = \" ".$tmplink."\">".highlight($display_val,$this->keywords)."</a>\n";
    				$outstring .= "</td>\n";
                        $outstring .= "</tr>";
			    }
			}
		}
		else {
			if ($this->search_options['show_empty']=="on") {
				$outstring= "<tr><th><b>".$AppUI->_($this->table_title). ' (' . count($results) . ')'."</b></th></tr> \n";
				$outstring .= "<tr>"."<td>".$AppUI->_('Empty')."</td>"."</tr>";
			}
		}
		return $outstring;
	}
	
	function setKeyword($keyw){
		$this->keyword= $keyw;
	}
	function setAdvanced($search_opts){
		$this->search_options = $search_opts;
		$this->keywords= $search_opts['keywords'];
	}
	
	function _buildQuery(){
                $q  = new DBQuery;
                $q->addTable($this->table);
                $q->addQuery($this->table_key);
                if (isset($this->table_key2))
                	$q->addQuery($this->table_key2);
//--MSy--
  				foreach($this->display_fields as $fld){
					$q->addQuery($fld);
				}
                $q->addOrder($this->table_orderby);
				
                if ($this->table_extra)
                	$q->addWhere($this->table_extra);
                
                $sql = '';
				foreach(array_keys($this->keywords) as $keyword) {
				$sql.= '(';

					foreach($this->search_fields as $field){
//OR treatment to each keyword
// Search for semi-colons, commas or spaces and allow any to be separators
						$or_keywords = preg_split('/[\s,;]+/', $keyword);
						foreach ($or_keywords as $or_keyword) {
							if ($this->search_options['ignore_specchar']=="on"){
								$tmppattern = recode2regexp_utf8($or_keyword);
								if ($this->search_options['ignore_case']=="on")
									$sql.=" $field REGEXP '$tmppattern' or ";
								else
									$sql.=" $field REGEXP BINARY '$tmppattern' or ";
							}	
							else
								if ($this->search_options['ignore_case']=="on")
									$sql.=" $field LIKE '%$or_keyword%' or ";
								else
									$sql.=" $field LIKE BINARY '%$or_keyword%' or ";
						}
					} // foreach $field
					$sql = substr($sql,0,-4);

					if ($this->search_options['all_words']=="on")
						$sql.= ') and ';
					else
						$sql.= ') or ';

                } // foreach $keyword
//--MSy--					
                $sql = substr($sql,0,-4);
                if ($sql) {
                	$q->addWhere($sql);
                	return $q->prepare(true);
                } else {
                	return '/* */';
                }
	}
}	
?>
