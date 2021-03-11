<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json;');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/specie.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$return["success"] = true;
	$return["response"] = getMonsters($data["i"]);

	print_r(pretty_json(json_encode($return)));

?>