<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");
	include("../../../class/specie.php");
	include("../../../class/crest.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	if($data[choiseAction] == "HACKMONOCRESTCHANGE"){

		$user = getUser($data[userId]);

		if($user[wallet] >= 200){
			$crestId = 0;

			if($data[choise] == "Courage") 			$crestId = 1;
			if($data[choise] == "Friendship") 		$crestId = 2;
			if($data[choise] == "Love") 			$crestId = 3;
			if($data[choise] == "Knowledge") 		$crestId = 4;
			if($data[choise] == "Sincerity") 		$crestId = 5;
			if($data[choise] == "Reliability") 		$crestId = 6;
			if($data[choise] == "Hope") 			$crestId = 7;
			if($data[choise] == "Light") 			$crestId = 8;
			if($data[choise] == "Kindness") 		$crestId = 9;
			if($data[choise] == "Destiny") 			$crestId = 10;
			if($data[choise] == "Miracles") 		$crestId = 11;

			$r = $db->select("vms_users_has_crests", "WHERE user = '$data[userId]'");
			$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

			if($crest == null){
				$return["success"] = false;
				$return["message"] = "Ocorreu um erro, tente novamente mais tarde...";
			}else{
				$crest[crest] = $crestId;
				$r = $db->update("vms_users_has_crests", $crest);

				$u = array(
					"id" => $user[id],
					"wallet" => $user[wallet] - 200
				);
				$r = $db->update("vms_users", $u);

				$return["success"] = true;
				$return["response"] = getCrest($crestId);
			}
		}else{
			$return["success"] = false;
			$return["message"] = "Você não tem dinheiro para fazer isso...";
		}

	}

	print_r(pretty_json(json_encode($return)));

?>