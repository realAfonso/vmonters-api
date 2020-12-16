<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json; charset=utf-8');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/data.php");	
	include("../../../class/specie.php");
	include("../../../class/crest.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$return = array();
	$return["success"] = true;

	$monsterId 		= $data["monsterId"];

	$return["response"] = getEvolutions($monsterId);

	print_r(pretty_json(json_encode($return)));

?>

















