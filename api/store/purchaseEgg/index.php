<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$return = array();

	$r = $db->select("vms_eggs", "WHERE id = '".$data["e"]."'");
	$e = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($e == null) {
		$return["success"] = false;
		$return["code"] = 1;
		$return["message"] = "Não tem ovo";
	}else{

		$r = $db->select("vms_users", "WHERE id = '".$data["i"]."'");
		$u = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($u == null) {
			$return["success"] = false;
			$return["code"] = 1;
			$return["message"] = "Usuário falso";
		}else{

			if($u["wallet"] >= $e["price"]){
				$wallet = $u["wallet"] - $e["price"];

				$uhe = array();
				$uhe["user"] = $data["i"];
				$uhe["egg"] = $data["e"];

				$r = $db->insert("vms_user_has_eggs", $uhe);
				$o = $db->sql("UPDATE vms_users SET wallet = '$wallet' WHERE id = '".$data["i"]."'");

				if($r == true){
					$return["success"] = true;
					$return["code"] = 1;
					$return["message"] = "sucesso";
					$return["response"] = $wallet;
				}
			}else{

				$return["success"] = false;
				$return["code"] = 1;
				$return["message"] = "Não tem dinheiro";
			}
			
		}

	}


	print_r(pretty_json(json_encode($return)));

?>