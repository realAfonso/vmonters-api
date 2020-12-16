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

	$r = $db->select("vms_users", " WHERE id = '$data[userId]'");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user == null){
		$return["success"] = false;
		$return["message"] = "Usuário não existe";
	}else{
		$user[reputation] = $user[reputation] + $data[reputation];
		$r = $db->update("vms_users", $user);
	}

	$return["success"] = true;
	$return["response"] = $data[reputation];

	print_r(pretty_json(json_encode($return)));

?>