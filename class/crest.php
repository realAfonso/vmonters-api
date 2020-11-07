<?

	function getCrestName($crestId) {
		$db = new Database();

		$r = $db->select("vms_crests", " WHERE id = '$crestId'");
		$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($crest == null) return null;

		return $crest["name"];
	}

	function randomCrestId(){
		$db = new Database();

		$r = $db->sql("SELECT COUNT(id) as count FROM vms_crests");
		$crests = mysqli_fetch_array($r, MYSQLI_ASSOC);

		return rand(1, $crests["count"]);
	}


	function getCrest($crestId) {
		$return = array();

		if ($crestId == 0) {
			$return["id"] = "0";
			$return["name"] = "Neutral";
			$return["icon"] = "http://api.vmonsters.com/assets/crests/0.png";
			$return["colorLight"] = "#333333";
			$return["colorDark"] = "#333333";
		} else {
			$db = new Database();

			$r = $db->select("vms_crests", " WHERE id = '$crestId'");
			$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

			if($crest == null) return null;

			$return["id"] = $crest["id"];
			$return["name"] = $crest["name"];
			$return["icon"] = "http://api.vmonsters.com/assets/crests/".$crest["icon"];
			$return["colorLight"] = $crest["color_light"];
			$return["colorDark"] = $crest["color_dark"];
		}

		return $return;
	}

?>