<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../../class/pretty_json.php");
	include("../../../../class/connection.php");
	include("../../../../class/database.php");
	include("../../../../class/user.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();
	$u = new User();

	$r = $db->select("vms_user_has_friends", "WHERE user = '".$data["i"]."' AND friend = '".$data["f"]."'");
	$friend = mysqli_fetch_array($r, MYSQLI_ASSOC);

	$friendshipId = $friend["id"];

	$uhf = array();
	$uhf["id"] = $friendshipId;
	$uhf["nickname"] = $data["n"];

	if($data["n"] == ""){
		$r = $db->sql("UPDATE vms_user_has_friends SET nickname = NULL WHERE id = '$friendshipId'");
	} else {
		$r = $db->update("vms_user_has_friends", $uhf);
	}

	if($r == true){
		$return["success"] = true;
		$return["code"] = 14;
		$return["message"] = "Friend added with success";
		$return["response"] = $u->getFriend($data["i"], $data["f"]);
	}else{
		$return["success"] = false;
		$return["code"] = 1;
		$return["message"] = "Is current friend";
	}

	print_r(pretty_json(json_encode($return)));

?>