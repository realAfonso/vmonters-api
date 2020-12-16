<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include_once("../../../class/pretty_json.php");
	include_once("../../../class/connection.php");
	include_once("../../../class/database.php");
	include_once("../../../class/user.php");
	include_once("../../../class/specie.php");
	include_once("../../../modules/_utilities.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$r = $db->select("vms_users", "WHERE id = '".$data["i"]."'");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user != null){
		$r = $db->select("vms_user_has_species", "WHERE user = '".$data["i"]."' AND buddy = '1'");
		$uhs = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($uhs != null){
			$return["success"] = false;
			$return["code"] = 13;
			$return["message"] = "User already has a partner";
			$return["response"] = null;
		}else{

			$babies = array();

			while(sizeof($babies) == 0){
			
				$rarity = getRandomRarity();

				$r = $db->select("vms_species", " WHERE rarity = '$rarity' AND level = 'BABY'");
				while($item = mysqli_fetch_array($r, MYSQLI_ASSOC)){
					array_push($babies, $item);
				}

			}

			if(sizeof($babies) == 0){
				$return["success"] = false;
				$return["code"] = 14;
				$return["message"] = "No babies are available";
				$return["response"] = null;
			}else{
				$baby = rand(0, (sizeof($babies)-1));

				$buddy = $babies[$baby];

				$uhs = array(
					"user" => $data["i"],
					"specie" => $buddy["id"],
					"name" => $buddy["name"],
					"personality" => getRandomPersonality(),
					"buddy" => true
				);

				$r = $db->insert("vms_user_has_species", $uhs);
				$r = $db->insert("vms_monster_has_step", array("monster" => $r, "specie" => $buddy["id"]));

				if($r){
					$u = new User();
					$r = $u->getBuddy($data["i"]);
					$return["success"] = true;
					$return["response"] = $r;
				}else{
					$return["success"] = false;
					$return["code"] = 15;
					$return["message"] = "There was an error saving partner";
					$return["response"] = null;
				}
			}
		}

	}else{
		$return["success"] = false;
		$return["code"] = 16;
		$return["message"] = "User does not exist";
		$return["response"] = null;
	}



	print_r(pretty_json(json_encode($return)));

?>