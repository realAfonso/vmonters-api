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

	$r = $db->delete("vms_user_has_friends", $friendshipId);

	$r = $db->select("vms_user_has_friends", "WHERE friend = '".$data["i"]."' AND user = '".$data["f"]."'");
	$friend = mysqli_fetch_array($r, MYSQLI_ASSOC);

	$friendshipId = $friend["id"];

	$r = $db->delete("vms_user_has_friends", $friendshipId);

	if($r == true){
		$return["success"] = true;
		$return["code"] = 14;
		$return["message"] = "Friend added with success";
	}else{
		$return["success"] = false;
		$return["code"] = 1;
		$return["message"] = "Is current friend";
	}

	print_r(pretty_json(json_encode($return)));

?>