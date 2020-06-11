<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$r = $db->select("vms_active_users", 
		" WHERE email = '".$data["email"]."' AND password = '".md5($data["password"])."'");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user == null){
		$return["success"] = false;
		$return["code"] = 12;
		$return["message"] = "Invalid email or password";
	}else{
		$return["id"] = $user["id"];
		$return["name"] = $user["name"];

		$crestId = $user["crest"];

		$r = $db->select("vms_crests", " WHERE id = '$crestId'");
		$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

		$return["crest"] = array();
		$return["crest"]["name"] = $crest["name"];
		$return["crest"]["icon"] = $crest["icon"];
		$return["crest"]["color"] = $crest["color"];
	}


	print_r(pretty_json(json_encode($return)));

?>