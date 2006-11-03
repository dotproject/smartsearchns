<?php /* SMARTSEARCHNS$Id: smartsearchns_func.php,v 1.0 2006/11/02 20:30:00 pedroix Exp $ */
/*
 function recode2regexp_utf8($input) 
 */
// create regexp to ignore (replace) some special czech / slovak characters 
// SAMPLE USAGE:
// 	$tmppattern = $recode2regexp_utf8("Mazgutova")
// 	mysql_query("SELECT first_name, last_name FROM contacts WHERE last_name  REGEXP '$tmppatern';");
//----------------------------------------------------------------
function recode2regexp_utf8($input) {
//----------------------------------------------------------------
// ToDo : 
//	add parameter for case sensitive/insensitive replacement
$result="";
for($i=0; $i<strlen($input); ++$i)
switch($input[$i]) {
    case 'A':
    case 'a':
		$result.="(a|á|ä|�?|Ä)";
		break;
    case 'C':
    case 'c':
		$result.="(c|�?|Č)";
		break;
    case 'D':
    case 'd':
		$result.="(d|�?|Ď)";
		break;
    case 'E':
    case 'e':
		$result.="(e|é|ě|É|Ě)";
		break;
    case 'I':
    case 'i':
		$result.="(i|í|�?)";
		break;
    case 'L':
    case 'l':
		$result.="(l|ĺ|ľ|Ĺ|Ľ)";
		break;
    case 'N':
    case 'n':
		$result.="(n|ň|Ň)";
		break;
    case 'O':
    case 'o':
		$result.="(o|ó|ô|Ó|Ô)";
		break;
    case 'R':
    case 'r':
		$result.="(r|ŕ|ř|Ŕ|Ř)";
		break;
    case 'S':
    case 's':
		$result.="(s|š|Š)";
		break;
    case 'T':
    case 't':
		$result.="(t|ť|Ť)";
		break;
    case 'U':
    case 'u':
		$result.="(u|ú|ů|Ú|Ů)";
		break;
    case 'Y':
    case 'y':
		$result.="(y|ý|�?)";
		break;
    case 'Z':
    case 'z':
		$result.="(z|ž|Ž)";
		break;
    default:
		$result.=$input[$i];
}
return $result;
}

/*
 function highlite
*/
// highlite searched text
//----------------------------------------------------------------
function highlight($text, $keyval) {
//----------------------------------------------------------------
//--MSy-- 	return str_replace($key, '<span style="background: yellow">'.$key.'</span>', $text);
//--MSy--
//--MSy--    case insensitive replacement with support eastern languages e.g. czech and slovak special chars
//--MSy-- 	return eregi_replace ( (sql_regcase($key)), "<span style=\"background:yellow\" >\\0</span>", $text ); 

$txt = $text;
$hicolor = array("#FFFF66","#ADD8E6","#90EE8A","#FF99FF");
$keys=array();
if (!is_array($keyval)) 
	$keys=array($keyval);
else
	$keys=$keyval;
	
foreach ($keys as $key) {
	if (strlen($key[0])>0) {
		if (isset ($_POST['ignorespecchar']) && ($_POST['ignorespecchar']=="on") ) 
			$txt= eregi_replace ( (recode2regexp_utf8($key[0])), "<span style=\"background:".$hicolor[$key[1]]."\" >\\0</span>", $txt ); 
		else
			$txt= eregi_replace ( (sql_regcase($key[0])), "<span style=\"background:".$hicolor[$key[1]]."\" >\\0</span>", $txt ); 
	}
}
return $txt; 
}
?>