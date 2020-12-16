<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$specie = array();

	$r = $db->select("vms_user_has_hightree_scene", " WHERE user = '$data[userId]' AND apartament = '$data[apartamentId]'");
	$scene = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($scene == null){
		$scene = array(
			"user" => $data[userId],
			"apartament" => $data[apartamentId],
			"scene" => $data[sceneId]
		);
		$r = $db->insert("vms_user_has_hightree_scene", $scene);
	}else{
		$scene[scene] = $data[sceneId];
		$r = $db->update("vms_user_has_hightree_scene", $scene);
	}

	$return["success"] = true;
	$return["response"] = array(
		"id" => $data[apartamentId],
		"lastScene" => $data[sceneId]
	);

	print_r(pretty_json(json_encode($return)));

?>