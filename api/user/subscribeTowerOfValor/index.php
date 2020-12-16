<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");
	include("../../../class/log.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$towerOfValor = array(
		"user" => $data[userId],
		"points" => 0,
		"floor" => 1
	);

	$r = $db->insert("vms_user_has_valor", $towerOfValor);

	if($r <= 0){
		$return["success"] = false;
		$return["message"] = "Ocorreu um erro inesperado. Tente novamente mais tarde.";
		log_activity($data[userId], "Erro ao se inscrever na Tower of Valor");
	}else{
		$u = $db->select("vms_user_has_valor", "WHERE id = '$r'");
		$uhv = mysqli_fetch_array($u, MYSQLI_ASSOC);

		$return["success"] = true;
		$return["response"] = $uhv;

		log_activity($data[userId], "Se inscreveu na Tower of Valor");
	}


	print_r(pretty_json(json_encode($return)));

?>