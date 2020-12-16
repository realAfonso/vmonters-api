<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/log.php");
	include("../../../modules/_mail_module.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	log_activity($data[userId], "Tentando salvar cena: $data[sceneId]");

	$specie = array();

	$key = explode("_", $data[sceneId]);

	$r = $db->select("vms_user_has_scene", " WHERE user = '$data[userId]' AND scene LIKE '$key[0]%'");
	$scene = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($scene == null){
		$scene = array(
			"user" => $data[userId],
			"scene" => $data[sceneId]
		);
		$r = $db->insert("vms_user_has_scene", $scene);
	}else{
		$scene[scene] = $data[sceneId];
		$r = $db->update("vms_user_has_scene", $scene);
	}

	log_activity($data[userId], "Cena salva com sucesso: $data[sceneId]");

	$return["success"] = true;
	$return["response"] = $data[sceneId];

	print_r(pretty_json(json_encode($return)));

?>