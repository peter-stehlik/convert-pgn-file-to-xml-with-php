$file = 'carlsen.pgn';

/*
* load .pgn file
*/
$pgn = file_get_contents($file);

/*
* modify, unify file structure to loop
*/
// note the space before result, VERY IMPORTANT to differ from XML Result element
$pgn = str_replace(' 1-0', ' 1-0"]+/Game+', $pgn);
$pgn = str_replace(' 0-1', ' 0-1"]+/Game+', $pgn);
$pgn = str_replace(' 1/2-1/2', ' 1/2-1/2"]+/Game+', $pgn);
$pgn = str_replace(' 0-0', ' 0-0"]+/Game+', $pgn);
$pgn = str_replace("[Event ", "+Game+[Event ", $pgn);
$pgn = str_replace("\n1. ", "[Moves \"1. ", $pgn);
$pgn = str_replace("&#xD;", " ", $pgn);
$pgn = str_replace("\r", " ", $pgn);

/*
* remove time information from moves, if presented
*/
$time_info = true;
while( $time_info ){
	$time_start = strpos($pgn, "{["); // find FIRST occurance
	$time_end = strpos($pgn, "]}");
	
	if( $time_start != false ){
		$time_info = substr($pgn, $time_start, $time_end-$time_start+3);
		$pgn = str_replace($time_info, "", $pgn);
	}else{
		$time_info = false;
	}
}

// prepare XML document
$xml = new SimpleXMLElement('<Games></Games>');

/*
* loop throught all games and create XML document
*/
$next_game = true;
while($next_game){
	$pgn = substr_replace($pgn, '*', 0, 0); // IMPORTANT not to have $opening_tag on 0 position, because it is always false then
	$opening_tag = strpos($pgn, "+Game+"); // find FIRST occurance
	$closing_tag = strpos($pgn, "+/Game+"); // the length is 7, which is then added to $query
	$gap = ' ';
	
	if ($opening_tag != false) { // if game exists
		$node = $xml->addChild('Game'); // when game exists, create element in $xml
		
		$erase_query = $query = substr($pgn, $opening_tag, $closing_tag-$opening_tag+7); // this is one game
		$query = str_replace("*", "", $query);
		$query = str_replace("\n", "", $query);
		
		/*
		* loop throught all parameters of current game & create XML structure
		*/
		$next_parameter = true; 
		while($next_parameter) {
			$subquery = substr_replace($query, '*', 0, 0);
			
			// get substring where we can find XML child elements & their value
			$opening_pos = strpos($subquery, '[');
			$closing_pos = strpos($subquery, ']');
			
			if ($opening_pos != false) {
				$subquery = substr($subquery, $opening_pos, $closing_pos-$opening_pos+2); // one parameter

				// get XML child element and value
				$gap_pos	= strpos($subquery, $gap);
				$lq_pos		= $gap_pos+2;
				$rq_pos	= strlen($subquery)-1;
				$xml_el		= substr($subquery, 1, $gap_pos-1);
				$el_val		= substr($subquery, $lq_pos, $rq_pos-$lq_pos-1);
				$el_val		= str_replace("\"", "", $el_val);
					
				// create child element of the game
				$node->addChild($xml_el, $el_val);

				// delete this parameter, look for another
				$query = str_replace($subquery, "", $query);
			}else{
				$next_parameter = false;
			}
		};
		// delete this game, look for another
		$pgn = str_replace($erase_query, "", $pgn);
	}else{
		$next_game = false;
	}
}

$xml = $xml->saveXML();
$xml = str_replace("\n", "", $xml); // sometimes can occur problem with whitespace

/*
* save XML file
*/	
file_put_contents('uploads/chessdb.xml', $xml);
