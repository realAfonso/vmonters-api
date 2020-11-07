<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../../class/pretty_json.php");
	include("../../../../class/connection.php");
	include("../../../../class/database.php");
	include("../../../../class/user.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();
	$u = new User();

	$r = $db->select("vms_active_avatars", "WHERE user = '".$data["i"]."' ORDER BY id ASC");

	if($r == null){
		$return["success"] = false;
		$return["code"] = 12;
		$return["message"] = "User have no avatars";
		$return["response"] = null;
	}else{

		$return["success"] = true;
		$return["response"] = array();

		while($a = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			$avatar = array();
			$avatar = $a;
			unset($avatar["user"]);

			$avatar["image"] = "http://api.vmonsters.com/assets/avatars/".$avatar["image"];

			if($avatar["isDefault"] == "1"){
				$avatar["isDefault"] = true;
			}else{
				$avatar["isDefault"] = false;
			}

			array_push($return["response"], $avatar);
		}
	}


	print_r(pretty_json(json_encode($return)));

?>