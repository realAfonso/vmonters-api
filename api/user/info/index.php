<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");
	include_once("../../../class/data.php");
	include("../../../class/date.php");
	include("../../../class/specie.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();
	$u = new User();

	$r = $db->select("vms_active_users", " WHERE id = '".$data["i"]."'");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user == null){
		$return["success"] = false;
		$return["code"] = 12;
		$return["message"] = "User don't exist";
		$return["response"] = null;
	}else{

		$return["success"] = true;
		$return["response"] = array();

		$return["response"]["id"] = $user["id"];
		$return["response"]["avatar"] = "http://api.vmonsters.com/assets/avatars/".$user["avatar"];
		$return["response"]["name"] = $user["name"];
		$return["response"]["wallet"] = $user["wallet"];
		$return["response"]["reputation"] = $user["reputation"];

		$return["response"]["buddy"] = getBuddy($user["id"]);

		$return["response"]["canConnect"] = userCanGiveData($user["id"]);

		$return["response"]["badge"] = getUserBadge($user["vip"], $user["type"]);

		$crestId = $user["crest"];

		$r = $db->select("vms_crests", " WHERE id = '$crestId'");
		$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

		$return["response"]["crest"] = array();
		$return["response"]["crest"]["id"] = $crest["id"];
		$return["response"]["crest"]["name"] = $crest["name"];
		$return["response"]["crest"]["icon"] = "http://api.vmonsters.com/assets/crests/".$crest["icon"];
		$return["response"]["crest"]["colorLight"] = $crest["color_light"];
		$return["response"]["crest"]["colorDark"] = $crest["color_dark"];

		$return["response"]["lastRequest"] = $user["lastRequest"];

		$return["response"]["template"] = "http://api.vmonsters.com/assets/templates/20201204193600.jpg";

		$return["response"]["hightree"] = array();

		$a = $db->select("vms_user_has_hightree_scene", "WHERE user = '$user[id]'");
		while($ap = mysqli_fetch_array($a, MYSQLI_ASSOC)){
			$apart = array(
				"id" => $ap[apartament],
				"lastScene" => $ap[scene]
			);
			array_push($return["response"]["hightree"], $apart);
		}

		$d = $db->select("vms_user_has_scene", "WHERE user = '$user[id]'");
		$academyScene = mysqli_fetch_array($d, MYSQLI_ASSOC);

		$return["response"]["academy"] = array(
			"house" => $user[house],
			"lastScene" => $academyScene[scene]
		);

		$return["response"]["towerOfValor"] = getTowerOfValor($user[id]);
	}


	print_r(pretty_json(json_encode($return)));

?>