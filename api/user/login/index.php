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
		$return["response"] = null;
	}else{

		$return["success"] = true;
		$return["response"] = array();

		$return["response"]["id"] = $user["id"];
		$return["response"]["name"] = $user["name"];

		$crestId = $user["crest"];

		$r = $db->select("vms_crests", " WHERE id = '$crestId'");
		$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

		$return["response"]["crest"] = array();
		$return["response"]["crest"]["name"] = $crest["name"];
		$return["response"]["crest"]["icon"] = $crest["icon"];
		$return["response"]["crest"]["colorLight"] = $crest["color_light"];
		$return["response"]["crest"]["colorDark"] = $crest["color_dark"];
	}


	print_r(pretty_json(json_encode($return)));

?>