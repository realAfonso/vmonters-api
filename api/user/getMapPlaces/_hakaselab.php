<?

	function getHakaseLabPlaces($places, $userId)
	{
		$db = new DataBase();

		$r = $db->select("vms_user_has_scene", "WHERE user = '$userId' AND scene LIKE 'HAKASELAB%' ORDER BY id DESC LIMIT 1");
		$scene = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($scene == null){
			$lastScene = null;
			$scenes = getHakaseLabFirstScene();
		}else{
			$lastScene = $scene[scene];
			if($lastScene == "HAKASELABFIRST_END" || $lastScene == "HAKASELABFIRST_013"){
				$lastScene = null;
				$scenes = getHakaseLabBuyScene();
			}else if((strpos($lastScene, "HAKASELABFIRST_") !== false) && $lastScene != "HAKASELABFIRST_END") {
				$scenes = getHakaseLabFirstScene();
			}
		}

		$place = array(
			"place" => "HAKASELAB",
			"lastScene" => $lastScene,
			"scenes" => $scenes
		);

		array_push($places, $place);

		return $places;
	}

?>