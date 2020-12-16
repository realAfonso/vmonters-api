<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include_once("../../../class/pretty_json.php");
	include_once("../../../class/connection.php");
	include_once("../../../class/database.php");
	include_once("../../../class/user.php");
	include_once("../../../class/date.php");
	include_once("../../../class/specie.php");
	include_once("../../../class/data.php");
	include_once("../../../class/log.php");

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

		$return["response"]["canConnect"] = userCanGiveData($user["id"]);

		$return["response"]["badge"] = getUserBadge($user["vip"], $user["type"]);

		$return["response"]["buddy"] = getBuddy($user["id"]);

		$crestId = $user["crest"];

		$r = $db->select("vms_crests", " WHERE id = '$crestId'");
		$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

		$return["response"]["crest"] = array();
		$return["response"]["crest"]["id"] = $crest["id"];
		$return["response"]["crest"]["name"] = $crest["name"];
		$return["response"]["crest"]["icon"] = "http://api.vmonsters.com/assets/crests/".$crest["icon"];
		$return["response"]["crest"]["colorLight"] = $crest["color_light"];
		$return["response"]["crest"]["colorDark"] = $crest["color_dark"];

		log_activity($user["id"], "Efetuou login");

		if(isToday($user["lastLogin"])){
			$return["response"]["bonus"] = null;
			log_activity($user["id"], "Não ganhou bonus diário");
		}else{
			if(isYesterday($user["lastLogin"])){
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

			$db = new Database();
			$r = $db->select("vms_bonus", " WHERE day = '$b'");
			while($bo = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				unset($bo["id"]);
				unset($bo["day"]);

				if($bo["type"] == "MONEY"){
					if($user[vip] >= 3) $bo["value"] = intval($bo["value"] * 1.5);
					$bn = array();
					$bn["id"] = $user["id"];
					$bn["wallet"] = $user["wallet"] + $bo["value"];
					$db->update("vms_users", $bn);

					$return["response"]["wallet"] = $user["wallet"] + $bo["value"];
					log_activity($user["id"], "Ganhou bonus diário: $bo[value]$");
				}else if($bo["type"] == "AVATAR"){
					$bn = array();
					$bn["user"] = $user["id"];
					$bn["avatar"] = $bo["value"];
					$db->insert("vms_user_has_avatars", $bn);

					$a = $db->select("vms_avatars", "WHERE id = '".$bo["value"]."'");
					$avatar = mysqli_fetch_array($a, MYSQLI_ASSOC);

					$bo["value"] = "http://api.vmonsters.com/assets/avatars/".$avatar["image"];

					log_activity($user["id"], "Ganhou bonus diário: $avatar[image]");
				}

				array_push($bonus, $bo);
			}

			if($user[vip] >= 4) {
				$bo = array();
				$bo["type"] = "DATA";
				$bo["value"] = 10;

				$uhd = $db->selectObject("vms_user_has_data", "WHERE user = '$user[id]' AND data = '0'");
				if($uhd == null){
					$uhd = array(
						"user" => $user[id],
						"data" => 0,
						"count" => 0
					);
					$db->insert("vms_user_has_data", $uhd);
					$uhd = $db->selectObject("vms_user_has_data", "WHERE user = '$user[id]' AND data = '0'");
				}else{
					$uhd[count] = $uhd[count] + 10;
				}

				$db->update("vms_user_has_data", $uhd);

				array_push($bonus, $bo);

				log_activity($user["id"], "Ganhou $bo[value] DigiData of Neutral como bonus diário");
			}

			if(date('w') == 6 && $user[house] != null){
				$mon = 500;
				if($user[vip] >= 4) $mon = intval($mon * 1.5);
				$bn = array();
				$bn["id"] = $user["id"];
				$bn["wallet"] = $return["response"]["wallet"] + $mon;
				$db->update("vms_users", $bn);

				$return["response"]["wallet"] = $return["response"]["wallet"] + $mon;

				array_push($bonus, array("type"=>"HOUSE", "value"=>$mon));

				log_activity($user["id"], "Ganhou auxílio semanal de $mon $");
			}

			if(sizeof($bonus) == 0){
				$bonus = null;
				log_activity($user["id"], "Não ganhou bonus diário");
			}

			$return["response"]["bonus"] = $bonus;
		}

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