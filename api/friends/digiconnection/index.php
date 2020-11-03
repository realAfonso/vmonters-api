<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Sao_Paulo");

	include_once("../../../class/pretty_json.php");
	include_once("../../../class/connection.php");
	include_once("../../../class/database.php");
	include_once("../../../class/user.php");
	include_once("../../../class/friends.php");
	include_once("../../../class/data.php");
	include_once("../../../class/date.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	if (userCanGiveData($data["userId"])) {
		$friends = getFriends($data["userId"]); 

		foreach($friends as $friend){
			giveData($data["userCrest"], $friend["id"], 1);
		}

		$count = sizeof($friends);

		giveData($data["userCrest"], $data["userId"], $count);

		$return = array();
		$return["success"] = true;
		$return["message"] = "DigiConnection realizada com sucesso!";
	} else {
		$return = array();
		$return["success"] = false;
		$return["message"] = "Usuário não pode realizar DigiConnection no momento...";
	}

	


	print_r(pretty_json(json_encode($return)));

?>