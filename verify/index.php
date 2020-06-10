<?

	ini_set("memory_limit","500M");

	include("../class/pretty_json.php");
	include("../class/connection.php");
	include("../class/database.php");
	include("../modules/_mail_module.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$hash = $data["h"];

	$db = new Database();

	$r = $db->select("vms_user_has_hash", " WHERE hash = '$hash'");
	$uhh = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($uhh == null){
		errorMessage();
	}else{
		$userId = $uhh["user"];

		$r = $db->select("vms_users", " WHERE id = '$userId'");
		$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($user == null){
			errorMessage();
		}else{
			$user["status"] = 1;
			$updated = $db->update("vms_users", $user);

			if($updated){
				$deleted = $db->delete("vms_user_has_hash", $uhh["id"]);
				if($deleted){
					sendWelcomeMail($user["email"], $user["name"]);
					successMessage();
				}else{
					errorMessage();
				}
			}else{
				errorMessage();
			}
		}
	}

	function successMessage()
	{
		?><center><h2>Success!</h2></center><?
	}

	function errorMessage()
	{
		?><center><h2>Error!</h2></center><?
	}


?>