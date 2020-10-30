<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Sao_Paulo");

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$store = array();

	$store["banners"] = array();

	$banner = array();
	$banner["image"] = "http://api.vmonsters.com/assets/banners/halloween.jpg";
	$banner["title"] = "Evento de Halloween";
	$banner["description"] = "Apenas no dia 31/10 estarão disponíveis na loja um digimon exclusivo e um avatar exclusivo!\n\nO tema de halloween deste ano é Gotsumon e Pumpkinmon, então espere ver algo relacionado a eles neste evento.";

	array_push($store["banners"], $banner);

	$banner = array();
	$banner["image"] = "http://api.vmonsters.com/assets/banners/testweek.jpg";
	$banner["title"] = "Semana de testes";
	$banner["description"] = "Apenas entre os dias 26/10 e 31/10 estará disponível na loja um avatar exclusivo para aqueles que estão ajudando a testar o game nesta primeira semana!\n\nO avatar selecionado é o Taichi de V-Tamers, nada mais perfeito para presentear os primeiros Tamers, do que o primeiro Tamer de Digimon!";

	array_push($store["banners"], $banner);

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

	$r = $db->select("vms_eggs", "WHERE status = '1'");
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

	$r = $db->select("vms_datas");
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