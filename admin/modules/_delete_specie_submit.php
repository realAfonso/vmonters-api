<?
	session_start();

	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set("America/Recife");

	include("../../class/connection.php");
	include("../../class/database.php");
	include("../../class/log.php");

	$dados = array();
	$dados = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$r = $db->delete("vms_species", $dados[i]);

	if($r == true) {
		log_activity($_SESSION[vms_user], "Deletou um Digimon: $dados[n]");
		exit("<script>location.href='../dashboard?o=ee&d=s';</script>");
	}else{
		exit("<script>location.href='../dashboard?o=ee&d=e';</script>");
	}

?>