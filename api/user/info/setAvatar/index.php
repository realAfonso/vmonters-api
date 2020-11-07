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

	$user = array();
	$user["id"] = $data["i"];
	$user["avatar"] = $data["a"];

	$r = $db->update("vms_users", $user);

	if($r == null){
		$return["success"] = false;
		$return["code"] = 12;
		$return["message"] = "Error";
		$return["response"] = null;
	}else{
		$return["success"] = true;
		$return["code"] = 1;
		$return["message"] = "Success";
		$return["response"] = null;
	}


	print_r(pretty_json(json_encode($return)));

?>