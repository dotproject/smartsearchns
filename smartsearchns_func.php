<?php /* SMARTSEARCHNS$Id: smartsearchns_func.php,v 1.1 2006/11/03 17:08:43 pedroix Exp $ */

function recode2regexp_utf8($input) {
      $result="";
      for($i=0; $i<strlen($input); ++$i)
      switch($input[$i]) {
          case 'A':
          case 'a':
      		$result.="(a|A!|A¤|A?|A„)";
      		break;
          case 'C':
          case 'c':
      		$result.="(c|Ä?|ÄO)";
      		break;
          case 'D':
          case 'd':
      		$result.="(d|Ä?|ÄŽ)";
      		break;
          case 'E':
          case 'e':
      		$result.="(e|A©|Ä›|A‰|Äš)";
      		break;
          case 'I':
          case 'i':
      		$result.="(i|A­|A?)";
      		break;
          case 'L':
          case 'l':
      		$result.="(l|Äo|Ä3|Ä1|Ä1)";
      		break;
          case 'N':
          case 'n':
      		$result.="(n|A^|A‡)";
      		break;
          case 'O':
          case 'o':
      		$result.="(o|A3|A´|A“|A”)";
      		break;
          case 'R':
          case 'r':
      		$result.="(r|A•|A™|A”|A~)";
      		break;
          case 'S':
          case 's':
      		$result.="(s|A!|A )";
      		break;
          case 'T':
          case 't':
      		$result.="(t|AY|A¤)";
      		break;
          case 'U':
          case 'u':
      		$result.="(u|Ao|A—|Aš|A®)";
      		break;
          case 'Y':
          case 'y':
      		$result.="(y|A1|A?)";
      		break;
          case 'Z':
          case 'z':
      		$result.="(z|A3|A1)";
      		break;
          default:
      		$result.=$input[$i];
      }
      return $result;
}

function highlight($text, $keyval) {
      global $ssearch;
      
      $txt = $text;
      $hicolor = array("#FFFF66","#ADD8E6","#90EE8A","#FF99FF");
      $keys=array();
      if (!is_array($keyval)) 
      	$keys=array($keyval);
      else
      	$keys=$keyval;
      	
      foreach ($keys as $key) {
      	if (strlen($key[0])>0) {
      	      $key[0] = stripslashes($key[0]);
      		if (isset ($ssearch['ignore_specchar']) && ($ssearch['ignore_specchar']=="on") ) {
      			if ($ssearch['ignore_case']=='on')
            			$txt= eregi_replace ( (recode2regexp_utf8($key[0])), "<span style=\"background:".$hicolor[$key[1]]."\" >\\0</span>", $txt ); 
      			else
            			$txt= ereg_replace ( (recode2regexp_utf8($key[0])), "<span style=\"background:".$hicolor[$key[1]]."\" >\\0</span>", $txt ); 
     			} elseif (!isset($ssearch['ignore_specchar']) || ($ssearch['ignore_specchar']=="") ) {
      			if ($ssearch['ignore_case']=='on')
            			$txt= eregi_replace ( $key[0], "<span style=\"background:".$hicolor[$key[1]]."\" >\\0</span>", $txt ); 
      			else
            			$txt= ereg_replace ( $key[0], "<span style=\"background:".$hicolor[$key[1]]."\" >\\0</span>", $txt );      			
     			} else {
     			    $txt= eregi_replace ( (sql_regcase($key[0])), "<span style=\"background:".$hicolor[$key[1]]."\" >\\0</span>", $txt ); 
		      }
      	}
      }
      return $txt; 
}
?>
