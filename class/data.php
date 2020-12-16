<?

	function getUserDatas($userId)
	{
		$db = new Database();

		$r = $db->select("vms_user_has_data", "WHERE user = '$userId'");

		$datas = array();

		while($d = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			$data = $d;

			$data["crest"] = getCrest($data["data"]);

			unset($data["id"]);
			unset($data["user"]);
			unset($data["data"]);

			array_push($datas, $data);
		}

		return $datas;
	}

	function getUserData($userId, $crestId)
	{
		$db = new Database();

		$r = $db->select("vms_user_has_data", "WHERE user = '$userId' AND data = '$crestId'");
		$data = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if ($data == null) return null;

		$data["crest"] = getCrest($data["data"]);

		unset($data["id"]);
		unset($data["user"]);
		unset($data["data"]);

		return $data;
	}

	function getUserHasData($userId, $crestId)
	{
		$db = new Database();

		$r = $db->select("vms_user_has_data", "WHERE user = '$userId' AND data = '$crestId'");
		$data = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if ($data == null) return null;

		return $data;
	}

	function discountDigiData($userId, $dataId, $count)
	{
		$digidata = getUserHasData($userId, $dataId);

		if ($digidata == null) return false;

		$db = new Database();

		$digidata["count"] = $digidata["count"] - $count;

		return $db->update("vms_user_has_data", $digidata);
	}

	function discountDigiDataFromEvolution($userId, $evolutionId)
	{
		$evolution = getSpecieEvolution($evolutionId);

		if ($evolution["data_neutral"] != null) {
			$return = discountDigiData($userId, 0, $evolution["data_neutral"]);

			if ($return == false) return false;
		}

		if ($evolution["data_courage"] != null) {
			$return = discountDigiData($userId, 1, $evolution["data_courage"]);

			if ($return == false) return false;
		}

		if ($evolution["data_friendship"] != null) {
			$return = discountDigiData($userId, 2, $evolution["data_friendship"]);

			if ($return == false) return false;
		}

		if ($evolution["data_love"] != null) {
			$return = discountDigiData($userId, 3, $evolution["data_love"]);

			if ($return == false) return false;
		}

		if ($evolution["data_knowledge"] != null) {
			$return = discountDigiData($userId, 4, $evolution["data_knowledge"]);

			if ($return == false) return false;
		}

		if ($evolution["data_sincerity"] != null) {
			$return = discountDigiData($userId, 5, $evolution["data_sincerity"]);

			if ($return == false) return false;
		}

		if ($evolution["data_reliability"] != null) {
			$return = discountDigiData($userId, 6, $evolution["data_reliability"]);

			if ($return == false) return false;
		}

		if ($evolution["data_hope"] != null) {
			$return = discountDigiData($userId, 7, $evolution["data_hope"]);

			if ($return == false) return false;
		}

		if ($evolution["data_light"] != null) {
			$return = discountDigiData($userId, 8, $evolution["data_light"]);

			if ($return == false) return false;
		}

		if ($evolution["data_kindness"] != null) {
			$return = discountDigiData($userId, 9, $evolution["data_kindness"]);

			if ($return == false) return false;
		}

		if ($evolution["data_destiny"] != null) {
			$return = discountDigiData($userId, 10, $evolution["data_destiny"]);

			if ($return == false) return false;
		}

		if ($evolution["data_miracles"] != null) {
			$return = discountDigiData($userId, 11, $evolution["data_miracles"]);

			if ($return == false) return false;
		}

		return true;
	}

	function getUserDataCount($userId, $crestId)
	{
		$db = new Database();

		$r = $db->select("vms_user_has_data", "WHERE user = '$userId' AND data = '$crestId'");
		$data = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if ($data == null) return null;

		return $data["count"];
	}

	function getDataFromStore($dataId)
	{
		$db = new Database();

		$r = $db->select("vms_datas", "WHERE id = '$dataId'");
		$data = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if ($data == null) return null;

		$data["image"] = "http://api.vmonsters.com/assets/datas/".$data["image"];

		return $data;
	}

	function giveData($crest, $target, $count, $sender)
	{
		$db = new Database();

		$r = $db->select("vms_user_has_data", "WHERE user = '$target' AND data = '$crest'");
		$data = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if ($data == null) {
			$data = array();
			$data["user"] = $target;
			$data["data"] = $crest;
			$data["count"] = $count;
			$db->insert("vms_user_has_data", $data);
		} else {
			$data["count"] = $data["count"] + $count;
			$db->update("vms_user_has_data", $data);
		}

		if ($target != $sender) {
			$filter = array(
				"field" => "tag", 
				"key" => "user", 
				"relation" => "=", 
				"value" => $target
			);

			$userName = getUserName($sender);
			$crestName = getCrestName($crest);

			$dados = array(
				"title" => "Você ganhou DigiData!",
				"message" => "$userName enviou uma DigiData of $crestName para você!",
				"filter" => $filter,
				"android" => true,
				"group" => "digiconnection"
			);

			preparePush($dados);
		}
	}

	function userCanGiveData($userId)
	{
		$db = new Database();

		$r = $db->select("vms_user_has_connected", "WHERE user = '$userId'");
		$connected = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if ($connected == null) {
			return true;
		} else if (isNotToday($connected["lastDate"])) { 
			return true;
		} else {
			return false;
		}
	}

	function setUserGivedData($userId)
	{
		$db = new Database();

		$r = $db->select("vms_user_has_connected", "WHERE user = '$userId'");
		$connected = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if ($connected == null) {
			$connected = array();
			$connected["user"] = $userId;
			$connected["lastDate"] = time();
			$db->insert("vms_user_has_connected", $connected);
		} else { 
			$connected["lastDate"] = time();
			$db->update("vms_user_has_connected", $connected);
		} 
	}

?>