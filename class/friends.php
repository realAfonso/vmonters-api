<?

	function getFriends($id)
	{
		$db = new Database();
		$user = new User();

		$friends = array();

		$r = $db->select("vms_active_friends", "WHERE userId = '$id'");
		while($f = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			$friend = array();
			$friend["id"] = $f["friendId"];
			$friend["nickname"] = $f["nickname"];
			$friend["name"] = $f["name"];
			$friend["avatar"] = "http://api.vmonsters.com/assets/avatars/".$f["avatar"];
			$friend["buddy"] = $user->getMonster($f["buddy"]);
			$friend["crest"] = $user->getCrest($f["crest"]);

			array_push($friends, $friend);
		}

		return $friends;
	}

?>