<?
	session_start();

	ini_set("memory_limit","500M");
	date_default_timezone_set("America/Recife");

	include_once("../../class/connection.php");
	include_once("../../class/database.php");
	include_once("../../class/log.php");

	$data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$r = $db->select("vms_active_users", 
		" WHERE email = '".$data["email"]."' AND password = '".md5($data["password"])."' AND type > 1");
	$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if($user == null){

		$_SESSION["vms_user"] = null;
		$_SESSION["vms_name"] = null;
		$_SESSION["vms_type"] = null;
		$_SESSION["vms_avatar"] = null;

		exit("<script>alert('Email ou senha inválidos! Verifique os dados e tente novamente!'');
				window.history.back();</script>");
	}else{
		$_SESSION["vms_user"] = $user["id"];
		$_SESSION["vms_name"] = $user["name"];
		$_SESSION["vms_type"] = $user["type"];
		$_SESSION["vms_avatar"] = "http://api.vmonsters.com/assets/avatars/".$user["avatar"];

		log_activity($user[id], "Efetuou login administrativo");

		exit("<script>location.href = '../dashboard';</script>");
	}

?>