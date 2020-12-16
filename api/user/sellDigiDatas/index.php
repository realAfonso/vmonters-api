<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/log.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$specie = array();

	$r = $db->select("vms_users", " WHERE id = '$data[userId]'");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	$r = $db->select("vms_user_has_data", " WHERE user = '$data[userId]' AND data = '$data[crestId]'");
	$digidata = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user == null || $digidata == null){
		$return["success"] = false;
		$return["response"] = "Ocorreu um erro, por favor, tente mais tarde...";
	}else{
		$user[wallet] = $user[wallet] + ($data[count]*3);
		$r = $db->update("vms_users", $user);

		$digidata[count] = $digidata[count] - $data[count];
		$r = $db->update("vms_user_has_data", $digidata);

		$cash = $data[count]*3;

		$crestName = 0;

		if($data[crestId] == 1) $crestName = "Courage";
		if($data[crestId] == 2) $crestName = "Friendship";
		if($data[crestId] == 3) $crestName = "Love";
		if($data[crestId] == 4) $crestName = "Knowledge";
		if($data[crestId] == 5) $crestName = "Sincerity";
		if($data[crestId] == 6) $crestName = "Reliability";
		if($data[crestId] == 7) $crestName = "Hope";
		if($data[crestId] == 8) $crestName = "Light";
		if($data[crestId] == 9) $crestName = "Kindness";
		if($data[crestId] == 10) $crestName = "Destiny";
		if($data[crestId] == 11) $crestName = "Miracles";

		log_activity($data[userId], "Vendeu $data[count] DigiDatas of $crestName e ganhou $cash $");

		$return["success"] = true;
		$return["response"] = $user[wallet];
	}

	print_r(pretty_json(json_encode($return)));

?>