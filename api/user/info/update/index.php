<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../../class/pretty_json.php");
	include("../../../../class/connection.php");
	include("../../../../class/database.php");
	include("../../../../modules/_mail_module.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$r = $db->select("vms_users", " WHERE id = '".$data["id"]."'");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user == null){
		$return["success"] = false;
		$return["code"] = 1;
		$return["message"] = "This user don't exist";
	}else{
		$success = $db->update("vms_users", $data);

		if ($success == true) {
			$return["success"] = true;
			$return["code"] = 14;
			$return["message"] = "Username updated with success";
		} else {
			$return["success"] = false;
			$return["code"] = 6;
			$return["message"] = "An error occurred";
		}
	}


	print_r(pretty_json(json_encode($return)));

?>