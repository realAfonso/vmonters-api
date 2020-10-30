<?
	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/push.php");

	$data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$db = new Database();

	$r = $db->select("vms_avatars", "WHERE id = '".$data["avatar"]."'");
	$avatar = mysqli_fetch_array($r, MYSQLI_ASSOC);

	$uha = array();
	$uha["avatar"] = $data["avatar"];

	foreach ($data["users"] as $user){
		$uha["user"] = $user;
		$db->insert("vms_user_has_avatars", $uha);

		$filter = array(
			"field" => "tag", 
			"key" => "user", 
			"relation" => "=", 
			"value" => $user
		);

		$dados = array(
			"title" => "Você ganhou um avatar!",
			"message" => "O seu presente está disponível na tela de seleção de avatares 😉",
			"filter" => $filter,
			"android" => true,
			"image" => "http://api.vmonsters.com/assets/avatars/".$avatar["image"]
		);

		preparePush($dados);
	}

?>

<script type="text/javascript">
	location.href = "../avatar";
</script>