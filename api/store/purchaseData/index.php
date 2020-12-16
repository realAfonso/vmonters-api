<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/data.php");
	include("../../../class/user.php");
	include("../../../class/specie.php");
	include("../../../class/crest.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$dataId = $data["dataId"];
	$userId = $data["userId"];

	$storeItem = getDataFromStore($dataId);

	if (userHasMoney($userId, $storeItem["price"])) {
		if (discountUserWallet($userId, $storeItem["price"])) {
			$return = getDataPurchased($userId, $dataId);
		} else {
			$return = array();
			$return["success"] = false;
			$return["message"] = "Não foi possível pagar pelo produto. Por favor, tente novamente mais tarde.";
		}
	} else {
		$return = array();
		$return["success"] = false;
		$return["message"] = "Você não possui saldo suficiente para fazer esta transação. Por favor, tente novamente quando tiver saldo disponível.";
	}

	print_r(pretty_json(json_encode($return)));

	function getDataPurchased($userId, $dataId)
	{
		$return = array();

		if ($dataId <= 3 || $dataId == 7 || $dataId == 8 || $dataId == 9){
			$crest = 0;
			$count = 0;

			if ($dataId == 1) {
				$count = 10;
			} else if ($dataId == 2) {
				$count = 20;
			} else if ($dataId == 3) {
				$count = 30;
			} else if ($dataId == 7) {
				$count = 60;
			} else if ($dataId == 8) {
				$count = 120;
			} else if ($dataId == 9) {
				$count = 250;
			}

			if(getUserVip($userId) >= 2) $count = intval($count * 1.1);

			giveData($crest, $userId, $count, $userId);

			$return["success"] = true;
			$return["response"] = array(
				0 => array(
					"count" => $count,
					"crest" => getCrest(0)
				)
			);
		} else {
			$count = 0;

			if ($dataId == 4) {
				$count = 10;
			} else if ($dataId == 5) {
				$count = 20;
			} else if ($dataId == 6) {
				$count = 30;
			}

			$digiDatas = array();

			for ($i = 1; $i <= $count; $i++) {
				$crestId = randomCrestId();

				giveData($crestId, $userId, 1, $userId);

				$finded = false;
				foreach ($digiDatas as $key => $value) {
					if ($value["crest"]["id"] == $crestId) {
						$digiDatas[$key]["count"]++;
						$finded = true;
					}
				}

				if ($finded == false) {
					$digiData = array();
					$digiData["count"] = 1;
					$digiData["crest"] = getCrest($crestId);

					array_push($digiDatas, $digiData);
				}

			}

			$return["success"] = true;
			$return["response"] = $digiDatas;

		}

		return $return;
	}

?>

















