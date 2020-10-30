<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../../class/pretty_json.php");
	include("../../../../class/connection.php");
	include("../../../../class/database.php");
	include("../../../../class/user.php");
	include("../../../../modules/_mail_module.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();
	$us = new User();

	$user_id = $data["i"];

	$friends = array();

	$uf = $us->getFriends($user_id);

	while($f = mysqli_fetch_array($uf, MYSQLI_ASSOC)){
		$friend = array();
		$friend["id"] = $f["friendId"];
		$friend["nickname"] = $f["nickname"];
		$friend["name"] = $f["name"];
		$friend["avatar"] = "http://api.vmonsters.com/assets/avatars/".$f["avatar"];
		$friend["buddy"] = $us->getMonster($f["buddy"]);
		$friend["crest"] = $us->getCrest($f["crest"]);

		array_push($friends, $friend);
	}

	$return["success"] = true;
	$return["code"] = 14;
	$return["message"] = "Friend list load with success";
	$return["response"] = $friends;

	print_r(pretty_json(json_encode($return)));

?>