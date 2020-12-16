<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$store = array();

	$store["banners"] = array();

	$banner = array();
	$banner["image"] = "http://api.vmonsters.com/assets/banners/vilans.jpg";
	$banner["title"] = "A era dos vilões!";
	$banner["description"] = "Começou a era dos vilões no V-Monsters!\n\nSão três novos avatares com os vilões mais amados e odiados da franquia! Devimon, Myotismon e Piedmon vieram assombrar os Tamers de V-Monsters!\n\nCompre já o avatar do seu vilão preferido ;)";

	array_push($store["banners"], $banner);

	$banner = array();
	$banner["image"] = "http://api.vmonsters.com/assets/banners/last_price.jpg";
	$banner["title"] = "Abaixou o preço!";
	$banner["description"] = "Todos os avatares de Last Evolution Kizuma tiveram seu preço reduzido!!\n\nSe você sempre quis comprar os avatares do último longa-metragem de Digimon, agora é a sua chance de pagar um preço bem camarada!";

	array_push($store["banners"], $banner);

	$banner = array();
	$banner["image"] = "http://api.vmonsters.com/assets/banners/digidata_update.jpg";
	$banner["title"] = "Atualização 0.1.2";
	$banner["description"] = "Bem vindos a atualização da DigiData!\n\nO que é DigiData?\n\nA DigiData é uma energia que emana do seu brasão, essa energia se torna física quando há uma conexão entre dois Tamers, o que permite que ela seja armazenada pelo Tamer para ser usada futuramente. A DigiData pode ser usada para evoluir o seu parceiro para diferentes espécies.\n\nTambém existe a DigiData Neutra, que é uma energia sem brasão, que pode ser adquirida na loja. A DigiData neutra funciona como experiência para o seu Digimon, então será necessário para que seu parceiro evolua!\n\nA DigiData Neutra pode ser conseguida apenas na loja, comprando os packs. A DigiData do seu brasão você pode conseguir criando uma DigiConnection com seus amigos a partir do menu de amigos. As DigiDatas de outros brasões você pode conseguir de duas formas:\n\n - Quando seus amigos fazem uma DigiConnection eles lhe dão uma data do brasão deles (tenha vários amigos);\n\n - Comprando os packs de DigiDatas aleatórios na loja, cada pack contém DigiDatas aleatórias, ao comprar-las você irá receber DigiDatas de todos os brasões.\n\nEsperamos que gostem dessa atualização ;)\n\nblablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla blablabla";

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