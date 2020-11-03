<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Sao_Paulo");

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

		$lastDate = date("Y-m-d", $user["lastLogin"]);
		$today = date("Y-m-d");
		$yesterday = date("Y-m-d", strtotime($today." - 1 days"));

		if($lastDate == $today){
			$return["response"]["bonus"] = null;
		}else{
			if($lastDate == $yesterday){
				$log = array();
				$log["id"] = $user["id"];
				$log["lastLogin"] = time();
				$log["lastDay"] = $user["lastDay"] + 1;

				$r = $db->update("vms_users", $log);

				$bonus = array();

				$b = $user["lastDay"] + 1;
			}else{
				$log = array();
				$log["id"] = $user["id"];
				$log["lastLogin"] = time();
				$log["lastDay"] = 1;

				$r = $db->update("vms_users", $log);

				$bonus = array();

				$b = 1;
			}

			$r = $db->select("vms_bonus", " WHERE id = '$b'");
			while($bo = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				unset($bo["id"]);
				unset($bo["day"]);

				if($bo["type"] == "MONEY"){
					$bn = array();
					$bn["id"] = $user["id"];
					$bn["wallet"] = $user["wallet"] + $bo["value"];
					$db->update("vms_users", $bn);
				}else if($bo["type"] == "AVATAR"){
					$bn = array();
					$bn["user"] = $user["id"];
					$bn["avatar"] = $bo["value"];
					$db->insert("vms_user_has_avatars", $bn);

					$r = $db->select("vms_avatars", "WHERE id = '".$bo["value"]."'");
					$avatar = mysqli_fetch_array($r, MYSQLI_ASSOC);

					$bo["value"] = "http://api.vmonsters.com/assets/avatars/".$avatar["image"];
				}

				array_push($bonus, $bo);
			}

			if(sizeof($bonus) == 0){
				$bonus = null;
			}

			$return["response"]["bonus"] = $bonus;
		}
	}


	print_r(pretty_json(json_encode($return)));

?>