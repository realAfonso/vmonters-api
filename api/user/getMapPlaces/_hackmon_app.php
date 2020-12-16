<?

	function getHackmonPlaces($places, $userId)
	{
		$db = new DataBase();

		$r = $db->select("vms_user_has_scene", "WHERE user = '$userId' AND scene LIKE 'HACKMON%' ORDER BY id DESC LIMIT 1");
		$scene = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($scene == null){
			$lastScene = null;
			$scenes = getHackmonFirstScene();
		}else{
			$lastScene = $scene[scene];
			if($lastScene == "HACKMONFIRST_END" || $lastScene == "HACKMONFIRST_007"){
				$lastScene = null;
				$scenes = getHackmonScene();
			}else if((strpos($lastScene, "HACKMONFIRST_") !== false) && $lastScene != "HACKMONFIRST_END") {
				$scenes = getHackmonFirstScene();
			}
		}

		$place = array(
			"place" => "OTHER",
			"icon" => "http://api.vmonsters.com/assets/map/ic_map_hackmon_app.png",
			"lastScene" => $lastScene,
			"scenes" => $scenes
		);

		array_push($places, $place);

		return $places;
	}

?>