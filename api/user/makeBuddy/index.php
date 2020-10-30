<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();
	$u = new User();

	$r = $db->select("vms_user_has_species", " WHERE id = '".$data["m"]."'");
	$m = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($m == null){
		$return["success"] = false;
		$return["code"] = 12;
		$return["message"] = "User don't exist";
	}else{

		$r = $db->sql("UPDATE vms_user_has_species SET buddy = '0' WHERE user = '".$m["user"]."' AND buddy = '1'");
		$r = $db->sql("UPDATE vms_user_has_species SET buddy = '1' WHERE id = '".$m["id"]."'");

		$return["success"] = true;
		$return["response"] = $u->getMonster($m["id"]);
	}


	print_r(pretty_json(json_encode($return)));

?>