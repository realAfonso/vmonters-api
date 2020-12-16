<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");
	include("../../../class/message.php");
	include("../../../class/specie.php");
	include("../../../class/crest.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$return["success"] = true;
	$return["response"] = getMessages($data[userId], $data[receiverId], $data[reference]);

	print_r(pretty_json(json_encode($return)));

?>