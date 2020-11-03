<?

	function giveData($crest, $target, $count)
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
	}

	function userCanGiveData($userId)
	{
		$db = new Database();

		$r = $db->select("vms_user_has_connected", "WHERE user = '$userId'");
		$connected = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if ($connected == null) {
			$connected = array();
			$connected["user"] = $userId;
			$connected["lastDate"] = time();
			$db->insert("vms_user_has_connected", $connected);
			return true;
		} else if (isNotToday($connected["lastDate"])) { 
			$connected["lastDate"] = time();
			$db->update("vms_user_has_connected", $connected);
			return true;
		} else {
			return false;
		}
	}

?>