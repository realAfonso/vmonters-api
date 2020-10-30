<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../../class/pretty_json.php");
	include("../../../../class/connection.php");
	include("../../../../class/database.php");
	include("../../../../class/user.php");
	include("../../../../class/push.php");
	include("../../../../modules/_mail_module.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();
	$u = new User();

	$friend_id = str_replace("PL-12", "", strtoupper($data["f"]));

	if($friend_id == $data["i"]){
		$return["success"] = false;
		$return["code"] = 1;
		$return["message"] = "Same user";
	}else{

		$r = $db->select("vms_user_has_friends", " WHERE user = '".$data["i"]."' AND friend = '".$friend_id."'");
		$uhf = mysqli_fetch_array($r, MYSQLI_ASSOC);

		if($uhf == null){
			$r = $db->select("vms_active_users", " WHERE id = '".$data["i"]."'");
			$thisuser = mysqli_fetch_array($r, MYSQLI_ASSOC);
			$user_name = $thisuser["name"];

			if($user_name == ""){
				$user_name = "Jogador12".$data["i"];
			}

			$r = $db->select("vms_active_users", " WHERE id = '".$friend_id."'");
			$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

			if($user == null){
				$return["success"] = false;
				$return["code"] = 1;
				$return["message"] = "This user don't exist";
			}else{
				$uhf1 = array();
				$uhf1["user"] = $data["i"];
				$uhf1["friend"] = $friend_id;

				$uhf2 = array();
				$uhf2["user"] = $friend_id;
				$uhf2["friend"] = $data["i"];

				$success1 = $db->insert("vms_user_has_friends", $uhf1);
				$success2 = $db->insert("vms_user_has_friends", $uhf2);

				if ($success1 == true && $success2 == true) {

					$filter = array(
						"field" => "tag", 
						"key" => "user", 
						"relation" => "=", 
						"value" => $friend_id
					);

					$dados = array(
						"title" => "Uma nova amizade!",
						"message" => $user_name." adicionou você a lista de amigos!",
						"filter" => $filter,
						"android" => true
					);

					preparePush($dados);

					$return["success"] = true;
					$return["code"] = 14;
					$return["message"] = "Friend added with success";
					$return["response"] = $u->getFriend($data["i"], $friend_id);
				} else {
					$return["success"] = false;
					$return["code"] = 6;
					$return["message"] = "An error occurred";
				}
			}
		}else{
			$return["success"] = false;
			$return["code"] = 1;
			$return["message"] = "Is current friend";
		}
	}

	print_r(pretty_json(json_encode($return)));

?>