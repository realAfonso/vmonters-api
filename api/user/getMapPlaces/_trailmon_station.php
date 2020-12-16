<?

	function getTrailmonStationPlaces($places, $userId)
	{
		$db = new DataBase();

		$r = $db->select("vms_user_has_scene", "WHERE user = '$userId' AND scene LIKE 'TRAILMONSTATION%' ORDER BY id DESC LIMIT 1");
		$scene = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($scene == null){
			$lastScene = null;
			$scenes = getTrailmonHakaseScene();
		}else{
			$lastScene = $scene[scene];
			if($lastScene == "TRAILMONSTATIONHAKASE_END" || $lastScene == "TRAILMONSTATIONHAKASE_015"){
				$lastScene = "TRAILMONSTATIONHAKASE_EMPTY";
				$scenes = getTrailmonEmptyScene();
			}else if((strpos($lastScene, "TRAILMONSTATIONHAKASE_") !== false) && $lastScene != "TRAILMONSTATIONHAKASE_END") {
				$scenes = getTrailmonHakaseScene();
			}
		}

		$place = array(
			"place" => "TRAILMONSTATION",
			"lastScene" => $lastScene,
			"scenes" => $scenes
		);

		array_push($places, $place);

		return $places;
	}

?>