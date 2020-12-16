<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");
	include("../../../class/log.php");
	include("../../../class/push.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$r = $db->select("vms_user_has_valor", "WHERE user = '$data[userId]'");
	$uhv = mysqli_fetch_array($r, MYSQLI_ASSOC);

	$nextFloor = $uhv[floor] + 1;

	$nextPoints = 10;

	for ($i=2; $i < $nextFloor; $i++) { 
		$nextPoints = $nextPoints * 2;
	}

	if($uhv[points] >= $nextPoints){

		$r = $db->select("vms_user_has_valor", "WHERE floor = '$nextFloor' LIMIT 1");
		$control = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($control != null){
			$uhv[floor] = $nextFloor;
			$db->update("vms_user_has_valor", $uhv);
			$return["success"] = true;
			log_activity($data[userId], "Subiu para o $nextFloor º andar da Tower of Valor");
		}else{
			$r = $db->select("vms_user_has_valor", "WHERE floor = '$uhv[floor]' AND points >= '$nextPoints' AND user != '$uhv[user]' LIMIT 1");
			$control = mysqli_fetch_array($r, MYSQLI_ASSOC);

			if($control != null){
				$prevFloor = $uhv[floor];
				$uhv[floor] = $nextFloor;
				$db->update("vms_user_has_valor", $uhv);
				$return["success"] = true;
				log_activity($data[userId], "Subiu para o $nextFloor º andar da Tower of Valor");

				$r = $db->select("vms_user_has_valor", "WHERE floor = '$prevFloor' AND points >= '$nextPoints'");
				while($u = mysqli_fetch_array($r, MYSQLI_ASSOC)){
					$u[floor] = $nextFloor;
					$db->update("vms_user_has_valor", $u);
					log_activity($u[user], "Subiu para o $nextFloor º andar da Tower of Valor");

					$filter = array(
						"field" => "tag", 
						"key" => "user", 
						"relation" => "=", 
						"value" => $u[user]
					);

					$dados = array(
						"title" => "Você subiu de andar!",
						"message" => "Outros jogadores chegaram ao $nextFloor º andar, agora você já pode batalhar no seu nível!",
						"filter" => $filter,
						"android" => true,
						"group" => "Tower of Valor"
					);

					preparePush($dados);
				}
			}else{
				$return["success"] = false;
				log_activity($data[userId], "Não subiu de andar na Tower of Valor (único jogador)");
			}
		}

	}else{
		$return["success"] = false;
		//log_activity($data[userId], "Não subiu de andar na Tower of Valor (pontos insuficientes)");
	}


	print_r(pretty_json(json_encode($return)));

?>