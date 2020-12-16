<?

	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set("America/Recife");

	include("../../../class/connection.php");
	include("../../../class/database.php");

	$dados = array();
	$dados = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$r = $db->delete("vms_specie_has_evolutions", $dados[i]);

	if($r == true) {
		exit("<script>alert('sucesso');location.href='../editevo';</script>");
	}else{
		exit("<script>alert('error');window.history.back();</script>");
	}

?>