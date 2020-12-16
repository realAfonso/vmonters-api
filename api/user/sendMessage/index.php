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
	include("../../../class/push.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$username = getUserName($data["userId"]);

	$message = array(
		"sender" => $data["userId"],
		"receiver" => $data["receiverId"],
		"reference" => $data["reference"],
		"message" => $data["message"],
		"hour" => time()
	);

	$r = $db->sql("DELETE FROM vms_messages WHERE (receiver = '$data[receiverId]' OR receiver = '$data[userId]') AND reference = '$data[reference]' ORDER BY hour ASC LIMIT 1");
	$r = $db->insert("vms_messages", $message);

	$filter = array(
		"field" => "tag", 
		"key" => "house", 
		"relation" => "=", 
		"value" => $data["reference"]
	);

	$filterNot = array(
		"field" => "tag", 
		"key" => "user", 
		"relation" => "!=", 
		"value" => $data["userId"]
	);

	$dados = array(
		"title" => $data["reference"],
		"message" => $username.": ".$data["message"],
		"filter" => $filter,
		"filterNot" => $filterNot,
		"android" => true,
		"group" => $data["reference"]
	);

	preparePush($dados);

	$return["success"] = true;
	$return["response"] = getMessages($data[userId], $data[receiverId], $data[reference]);

	print_r(pretty_json(json_encode($return)));

?>