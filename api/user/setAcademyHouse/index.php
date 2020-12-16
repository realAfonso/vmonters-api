<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/push.php");
	include("../../../class/user.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$data[house] = "Red Dragons";

	$return = array();

	$db = new Database();

	$username = getUserName($data["userId"]);

	$r = $db->select("vms_users", "WHERE id = '$data[userId]'");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user == null){
		$return["success"] = false;
		$return["message"] = "Este usuário não existe.";
	}else{
		$user[house] = $data[house];
		$r = $db->update("vms_users", $user);

		$filter = array(
			"field" => "tag", 
			"key" => "house", 
			"relation" => "=", 
			"value" => $data[house]
		);

		$filterNot = array(
			"field" => "tag", 
			"key" => "user", 
			"relation" => "!=", 
			"value" => $data[userId]
		);

		$dados = array(
			"title" => "Novo membro da $user[house]!",
			"message" => $username." acabou de entrar para os $user[house], dê as boas vindas a ele!",
			"filter" => $filter,
			"filterNot" => $filterNot,
			"android" => true,
			"group" => "Welcome ".$data[house]
		);

		preparePush($dados);
	}

	$return["success"] = true;
	$return["message"] = "Usuário atualizado com sucesso!";

	print_r(pretty_json(json_encode($return)));

?>