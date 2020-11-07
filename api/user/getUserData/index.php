<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Sao_Paulo");

	include_once("../../../class/pretty_json.php");
	include_once("../../../class/connection.php");
	include_once("../../../class/database.php");
	include_once("../../../class/user.php");
	include_once("../../../class/data.php");
	include_once("../../../class/crest.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();
	$return["success"] = true;
	$return["response"] = getUserData($data["userId"], $data["crestId"]);

	print_r(pretty_json(json_encode($return)));

?>