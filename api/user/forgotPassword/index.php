<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../modules/_mail_module.php");
	include("../../../modules/_utilities.php");

	$data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$r = $db->select("vms_users", " WHERE email = '".$data["email"]."'");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user != null){
		$return["success"] = false;
		$return["code"] = 008;
		$return["message"] = "This email does not belong to any user";
	}else{
		$newPass = createNewPassword();
		$oldPass = $user["password"];

		$user["password"] = md5($newPass);

		$updated = $db->update("vms_users", $user);

		if ($updated) {
			if(sendNewPasswordMail($user["email"], $user["name"], $newPass)){
				$return["success"] = true;
				$return["code"] = 011;
				$return["message"] = "An email with the new password was sent";
			}else{
				$user["password"] = $oldPass;
				$updated = $db->update("vms_users", $user);
				$return["success"] = false;
				$return["code"] = 010;
				$return["message"] = "An error occurred while sending the confirmation email";
			}
		}else{
			$return["success"] = false;
			$return["code"] = 009;
			$return["message"] = "There was an error updating your password";
		}
	}


	print_r(pretty_json(json_encode($return)));

?>