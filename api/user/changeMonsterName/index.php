<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();
	$u = new User();

	$uhs = array();
	$uhs["id"] = $data["m"];
	$uhs["name"] = $data["n"];

	$r = $db->update("vms_user_has_species", $uhs);

	if($r == false){
		$return["success"] = false;
		$return["message"] = "Ocorreu um erro inesperado. Tente novamente mais tarde.";
	}else{
		$return["success"] = true;
		$return["response"] = $u->getMonster($data["m"]);
	}


	print_r(pretty_json(json_encode($return)));

?>