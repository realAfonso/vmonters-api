<?

	function getTownhallEntracePlaces($places, $userId)
	{
		$db = new DataBase();

		$r = $db->select("vms_user_has_scene", "WHERE user = '$userId' AND scene LIKE 'TOWNHALLENTRACE%' ORDER BY id DESC LIMIT 1");
		$scene = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($scene == null){
			$lastScene = null;
			$scenes = getTownhallEntraceScene();
		}else{
			$lastScene = $scene[scene];
			if($lastScene == "TOWNHALLENTRACE_END" || $lastScene == "TOWNHALLENTRACE_027"){
				$lastScene = "TOWNHALLENTRACE_EMPTY";
				$scenes = getTownhallEntraceEmptyScene();
			}else if((strpos($lastScene, "TOWNHALLENTRACE_") !== false) && $lastScene != "TOWNHALLENTRACE_END") {
				$scenes = getTownhallEntraceScene();
			}
		}

		$place = array(
			"place" => "TOWNHALL",
			"lastScene" => $lastScene,
			"scenes" => $scenes
		);

		array_push($places, $place);

		return $places;
	}

	function getTownhallJijiRoomPlaces($places, $userId)
	{
		$db = new DataBase();

		$r = $db->select("vms_user_has_scene", "WHERE user = '$userId' AND scene LIKE 'TOWNHALLJIJIROOM%' ORDER BY id DESC LIMIT 1");
		$scene = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($scene == null){
			$lastScene = null;
			$scenes = getTownhallJijiRoomHakaseScene();
		}else{
			$lastScene = $scene[scene];

			if($lastScene == "TOWNHALLJIJIROOMHAKASESAVE_END" || $lastScene == "TOWNHALLJIJIROOMHAKASESAVE_008"){
				$lastScene = null;
				$scenes = getTownhallJijiRoomEmptyScene();

			}else if($lastScene == "TOWNHALLJIJIROOMHAKASE_END" || $lastScene == "TOWNHALLJIJIROOMHAKASE_001" || (strpos($lastScene, "TOWNHALLJIJIROOMHAKASESAVE_") !== false)){
				if(strpos($lastScene, "_END") !== false) $lastScene = null;
				$scenes = getTownhallJijiRoomHakaseSaveScene();

			}else if((strpos($lastScene, "TOWNHALLJIJIROOMHAKASE_") !== false) && $lastScene != "TOWNHALLJIJIROOMHAKASE_END") {
				$scenes = array();
			}
		}

		$place = array(
			"place" => "TOWNHALL_JIJIROOM",
			"lastScene" => $lastScene,
			"scenes" => $scenes
		);

		array_push($places, $place);

		return $places;
	}

?>