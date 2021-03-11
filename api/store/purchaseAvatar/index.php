<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/log.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$return = array();

	$r = $db->select("vms_store_avatars", "WHERE id = '".$data["a"]."'");
	$a = mysqli_fetch_array($r, MYSQLI_ASSOC);

    log_activity($data[i], "Usuário tentando comprar um avatar");

	if($a == null) {
		$return["success"] = false;
		$return["code"] = 1;
		$return["message"] = "Não tem avatar";
	}else{

		$r = $db->select("vms_users", "WHERE id = '".$data["i"]."'");
		$u = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($u == null) {
			$return["success"] = false;
			$return["code"] = 1;
			$return["message"] = "Usuário falso";
		}else{

			if($u["wallet"] >= $a["price"]){

                log_activity($data[i], "Usuário tem $u[wallet] $ na carteira");

				$wallet = $u["wallet"] - $a["price"];

                log_activity($data[i], "Descontando $a[price] $ da carteira do usuário");

				$uha = array();
				$uha["user"] = $data["i"];
				$uha["avatar"] = $data["a"];

				$r = $db->insert("vms_user_has_avatars", $uha);
				$o = $db->sql("UPDATE vms_users SET wallet = '$wallet' WHERE id = '".$data["i"]."'");

                log_activity($data[i], "Novo valor na carteira do usuário: $wallet $");

				if($r == true){
					$return["success"] = true;
					$return["code"] = 1;
					$return["message"] = "sucesso";
					$return["response"] = $wallet;
                    log_activity($data[i], "Usuário comprou um avatar com sucesso");
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