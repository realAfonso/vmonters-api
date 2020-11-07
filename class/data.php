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
				"android" => true
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