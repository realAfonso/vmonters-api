<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include("../../../../class/pretty_json.php");
	include("../../../../class/connection.php");
	include("../../../../class/database.php");
	include("../../../../class/log.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$user = $db->selectObject("vms_users", "WHERE id = '$data[i]'");

    log_activity($user["id"], "Valor na carteira: $user[wallet] $");

	$store = array();

	$store["banners"] = array();

	$r = $db->select("vms_news", "WHERE ((start <= '".time()."' AND end >= '".time()."') OR (start = '0' AND end = '0')) AND showOnStore = '1' ORDER BY id DESC");
	
	while($s = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		$s["simage"] = "http://api.vmonsters.com/assets/banners/".$s["simage"];
		$s["nimage"] = "http://api.vmonsters.com/assets/news/".$s["nimage"];
		unset($s["showOnStore"]);
		unset($s["start"]);
		unset($s["end"]);
		array_push($store["banners"], $s);
	}

	$store["specialAvatars"] = array();
	$store["avatars"] = array();

	$r = $db->select("vms_store_avatars");
	while($a = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		$avatar = $a;
		$avatar["image"] = "http://api.vmonsters.com/assets/avatars/".$avatar["image"];

		$avatar["isPurchased"] = false;

		$ra = $db->select("vms_user_has_avatars", "WHERE user = '".$data["i"]."' AND avatar = '".$a["id"]."'");
		$uha = mysqli_fetch_array($ra, MYSQLI_ASSOC);

		if($uha != null) $avatar["isPurchased"] = true;

		$now = time();

		if(($a["startDate"] <= $now && $a["endDate"] >= $now) || ($a["startDate"] == 0 && $a["endDate"] == 0)){
			if($a["price"] > 0){
				array_push($store["avatars"], $avatar);
			}else{
				array_push($store["specialAvatars"], $avatar);
			}
		}
	}

	$store["specialEggs"] = array();
	$store["eggs"] = array();

	$r = $db->select("vms_eggs", "WHERE status = '1' ORDER BY orderr ASC");
	while($e = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		$egg = $e;
		$egg["image"] = "http://api.vmonsters.com/assets/eggs/".$egg["image"];

		$egg["isPurchased"] = false;

		$now = time();

		if(($e["startDate"] <= $now && $e["endDate"] >= $now) || ($e["startDate"] == 0 && $e["endDate"] == 0)){
			if ($egg["price"] == 0) {	
				$ra = $db->select("vms_user_has_eggs", "WHERE user = '".$data["i"]."' AND egg = '".$e["id"]."'");
				$uhe = mysqli_fetch_array($ra, MYSQLI_ASSOC);

				if($uhe != null && $uhe["egg"] != 1) $egg["isPurchased"] = true;

				array_push($store["specialEggs"], $egg);
			} else {
				array_push($store["eggs"], $egg);
			}
		}
	}

	$store["datas"] = array();

	$r = $db->select("vms_datas", "ORDER BY orderr ASC");
	while($d = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		$data = $d;
		$data["image"] = "http://api.vmonsters.com/assets/datas/".$data["image"];
		array_push($store["datas"], $data);
	}

	$return = array();
	$return["success"] = true;
	$return["code"] = 1;
	$return["response"] = $store;


	print_r(pretty_json(json_encode($return)));

?>