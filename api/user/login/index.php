<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include_once("../../../class/pretty_json.php");
	include_once("../../../class/connection.php");
	include_once("../../../class/database.php");
	include_once("../../../class/user.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$u = new User();
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
		$return["response"]["avatar"] = "http://api.vmonsters.com/assets/avatars/".$user["avatar"];
		$return["response"]["name"] = $user["name"];
		$return["response"]["wallet"] = $user["wallet"];
		$return["response"]["reputation"] = $user["reputation"];

		$return["response"]["buddy"] = $u->getBuddy($user["id"]);

		$crestId = $user["crest"];

		$r = $db->select("vms_crests", " WHERE id = '$crestId'");
		$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

		$return["response"]["crest"] = array();
		$return["response"]["crest"]["name"] = $crest["name"];
		$return["response"]["crest"]["icon"] = "http://api.vmonsters.com/assets/crests/".$crest["icon"];
		$return["response"]["crest"]["colorLight"] = $crest["color_light"];
		$return["response"]["crest"]["colorDark"] = $crest["color_dark"];

		$return["response"]["lastRequest"] = $user["lastRequest"];
	}


	print_r(pretty_json(json_encode($return)));

?>