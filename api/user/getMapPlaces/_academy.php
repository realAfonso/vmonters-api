<?

	function getAcademyDormitoryPlaces($places, $userId)
	{
		$db = new DataBase();

		$r = $db->select("vms_user_has_scene", "WHERE user = '$userId' AND scene LIKE 'ACADEMYDORMITORY%' ORDER BY id DESC LIMIT 1");
		$scene = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($scene == null){
			$lastScene = null;
			$scenes = array();
		}else{
			$lastScene = $scene[scene];
			$scenes = array();
		}

		$place = array(
			"place" => "ACADEMY_DORMITORY",
			"lastScene" => $lastScene,
			"scenes" => $scenes
		);

		array_push($places, $place);

		return $places;
	}

	function getAcademyHallPlaces($places, $userId)
	{
		$db = new DataBase();

		$r = $db->select("vms_user_has_scene", "WHERE user = '$userId' AND scene LIKE 'ACADEMYHALL%' ORDER BY id DESC LIMIT 1");
		$scene = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($scene == null){
			$lastScene = null;
			$scenes = getAcademyMayorScene();
		}else{
			$lastScene = $scene[scene];
			if($lastScene == "ACADEMYHALLMAYOR_END" || $lastScene == "ACADEMYHALLMAYOR_005"){
				$lastScene = "ACADEMYHALLMAYOR_EMPTY";
				$scenes = getAcademyEmptyScene();
			}else 
			if((strpos($lastScene, "ACADEMYHALLMAYOR_") !== false) && $lastScene != "ACADEMYHALLMAYOR_END") {
				$scenes = getAcademyMayorScene();
			}
		}

		$place = array(
			"place" => "ACADEMY_HALL",
			"lastScene" => $lastScene,
			"scenes" => $scenes
		);

		array_push($places, $place);

		return $places;
	}

?>