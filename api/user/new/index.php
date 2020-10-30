<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../modules/_mail_module.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$data["password"] = md5($data["password"]);
	$data["wallet"] = 3000;

	$return = array();

	$db = new Database();

	$r = $db->select("vms_users", " WHERE email = '".$data["email"]."'");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user != null){
		$return["success"] = false;
		$return["code"] = 1;
		$return["message"] = "This email is already being used";
	}else{
		$userId = $db->insert("vms_users", $data);

		$uha = array();
		$uha["user"] = $userId;
		$uha["avatar"] = "1";

		$db->insert("vms_user_has_avatars", $uha);

		if ($userId > 0) {
			$r = $db->sql("SELECT COUNT(id) as count FROM vms_crests");
			$crests = mysqli_fetch_array($r, MYSQLI_ASSOC);

			$crestId = rand(1, $crests["count"]);

			$users_has_crests = array();
			$users_has_crests["user"] = $userId;
			$users_has_crests["crest"] = $crestId;

			$uhcId = $db->insert("vms_users_has_crests", $users_has_crests);

			if($uhcId > 0){

				$hash = md5($userId);
				$hash = md5($hash);

				$user_has_hash = array();
				$user_has_hash["user"] = $userId;
				$user_has_hash["hash"] = $hash;

				$uhhId = $db->insert("vms_user_has_hash", $user_has_hash);

				if($uhhId > 0){
					if(sendVerificationMail($data["email"], $hash)){
						$return["success"] = true;
						$return["code"] = 7;
						$return["message"] = "User created with success, verify your email account";
					}else{
						$db->delete("vms_users", $userId);
						$db->delete("vms_users_has_crests", $uhcId);
						$return["success"] = false;
						$return["code"] = 2;
						$return["message"] = "Verification email could not be sent, please try again";
					}
				}else{
					$db->delete("vms_users", $userId);
					$db->delete("vms_users_has_crests", $uhcId);
					$return["success"] = false;
					$return["code"] = 3;
					$return["message"] = "Verification hash could not be created, please try again";
				}				

			}else{
				$db->delete("vms_users", $userId);
				$return["success"] = false;
				$return["code"] = 5;
				$return["message"] = "An error occurred";
			}
		} else {
			$return["success"] = false;
			$return["code"] = 6;
			$return["message"] = "An error occurred";
		}
	}


	print_r(pretty_json(json_encode($return)));

?>