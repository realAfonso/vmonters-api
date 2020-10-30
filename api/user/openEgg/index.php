<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");
	include_once("../../../modules/_utilities.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();
	$u = new User();

	$specie = array();

	$r = $db->select("vms_eggs", " WHERE id = '".$data["e"]."'");
	$egg = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($egg == null){
		$return["success"] = false;
		$return["code"] = 12;
		$return["message"] = "User don't exist";
	}else{

		if($data["e"] == 1){

			$rarity = getRandomRarity();

			$babies = array();

			$r = $db->select("vms_species", " WHERE rarity = '$rarity' AND level = 'BABY'");
			while($item = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				array_push($babies, $item);
			}

			$baby = rand(0, (sizeof($babies)-1));
			$specie = $babies[$baby];

		}else{
			$r = $db->select("vms_species", " WHERE id = '".$egg["specie"]."'");
			$specie = mysqli_fetch_array($r, MYSQLI_ASSOC);
		}

		$uhs = array();
		$uhs["user"] = $data["i"];
		$uhs["specie"] = $specie["id"];
		$uhs["name"] = $specie["name"];
		$uhs["buddy"] = 0;

		$r = $db->sql("UPDATE vms_user_has_eggs SET isOpened = '1' WHERE egg = '".$data["e"]."' AND user = '".$data["i"]."' AND isOpened = '0' ORDER BY id DESC LIMIT 1");

		$r = $db->insert("vms_user_has_species", $uhs);

		$return["success"] = true;
		$return["response"] = $u->getMonster($r);
	}


	print_r(pretty_json(json_encode($return)));

?>