<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/log.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$r = $db->select("vms_user_has_place", " WHERE user = '$data[userId]' AND place = '$data[placeId]'");
	$place = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($place == null){
		$place = array(
			"user" => $data[userId],
			"place" => $data[placeId]
		);
		$r = $db->insert("vms_user_has_place", $place);

		log_activity($data[userId], "Local desbloqueado com sucesso: $data[placeId]");
	}

	$return["success"] = true;
	$return["response"] = $data[placeId];

	print_r(pretty_json(json_encode($return)));

?>