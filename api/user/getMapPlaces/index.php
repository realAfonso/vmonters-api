<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include("providers/_backgrounds.php");
	include("providers/_chars.php");

	include("scenes/_academy_hall_scenes.php");
	include("scenes/_townhall_entrace_scenes.php");
	include("scenes/_townhall_jijiroom_scenes.php");
	include("scenes/_trailmon_station_scenes.php");
	include("scenes/_hakaselab_scenes.php");
	include("scenes/_hackmon_app_scenes.php");

	include("_academy.php");
	include("_townhall.php");
	include("_trailmon_station.php");
	include("_hakaselab.php");
	include("_hackmon_app.php");

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$unlockedPlaces = array();

	$db = new Database();
	$r = $db->select("vms_user_has_place", "WHERE user = '$data[userId]'");
	while($i = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		array_push($unlockedPlaces, $i[place]);
	}

	$places = array();

	if(in_array("ACADEMY", $unlockedPlaces)) $places = getAcademyHallPlaces($places, $data[userId]);
	if(in_array("ACADEMY_DORMITORY", $unlockedPlaces)) $places = getAcademyDormitoryPlaces($places, $data[userId]);
	if(in_array("TOWNHALL", $unlockedPlaces)) $places = getTownhallEntracePlaces($places, $data[userId]);
	if(in_array("TOWNHALL_JIJIROOM", $unlockedPlaces)) $places = getTownhallJijiRoomPlaces($places, $data[userId]);
	if(in_array("TRAILMONSTATION", $unlockedPlaces)) $places = getTrailmonStationPlaces($places, $data[userId]);
	if(in_array("HAKASELAB", $unlockedPlaces)) $places = getHakaseLabPlaces($places, $data[userId]);

	if(sizeof($places) != 0){
		$timeIni1 = strtotime(date('d-m-Y').'00:00');
		$timeFim1 = strtotime(date('d-m-Y').'06:00');
		$timeIni2 = strtotime(date('d-m-Y').'22:00');
		$timeFim2 = strtotime(date('d-m-Y').'23:59');

		if((time() >= $timeIni1 && time() <= $timeFim1) || (time() >= $timeIni2 && time() <= $timeFim2)){
			$random = rand(1,100);
			if($random >= 1 && $random <= 5) {
				$places = getHackmonPlaces($places, $data[userId]);
			}
		}
	}

	$return["success"] = true;
	$return["response"] = $places;

	print_r(pretty_json(json_encode($return)));

?>