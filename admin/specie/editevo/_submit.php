<?

	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set("America/Recife");

	include("../../../class/connection.php");
	include("../../../class/database.php");

	$dados = array();
	$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	unset($dados["SALVAR"]);
	unset($dados["EXCLUIR"]);

	if($dados["data_neutral"] == "") 		$dados["data_neutral"] = null;
	if($dados["data_courage"] == "") 		$dados["data_courage"] = null;
	if($dados["data_friendship"] == "") 	$dados["data_friendship"] = null;
	if($dados["data_love"] == "") 			$dados["data_love"] = null;
	if($dados["data_knowledge"] == "") 		$dados["data_knowledge"] = null;
	if($dados["data_sincerity"] == "") 		$dados["data_sincerity"] = null;
	if($dados["data_reliability"] == "") 	$dados["data_reliability"] = null;
	if($dados["data_hope"] == "") 			$dados["data_hope"] = null;
	if($dados["data_light"] == "") 			$dados["data_light"] = null;
	if($dados["data_kindness"] == "") 		$dados["data_kindness"] = null;
	if($dados["data_destiny"] == "") 		$dados["data_destiny"] = null;
	if($dados["data_miracles"] == "") 		$dados["data_miracles"] = null;

	$db = new Database();

	$r = $db->update("vms_specie_has_evolutions", $dados);

	if($r == true) {
		exit("<script>alert('sucesso');location.href='../editevo';</script>");
	}else{
		exit("<script>alert('error');window.history.back();</script>");
	}

?>