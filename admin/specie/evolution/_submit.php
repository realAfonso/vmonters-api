<?

	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set("America/Recife");

	include("../../../class/connection.php");
	include("../../../class/database.php");

	$dados = array();
	$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	unset($dados["CADASTRAR"]);

	if($dados["data_neutral"] == "") 		unset($dados["data_neutral"]);
	if($dados["data_courage"] == "") 		unset($dados["data_courage"]);
	if($dados["data_friendship"] == "") 	unset($dados["data_friendship"]);
	if($dados["data_love"] == "") 			unset($dados["data_love"]);
	if($dados["data_knowledge"] == "") 		unset($dados["data_knowledge"]);
	if($dados["data_sincerity"] == "") 		unset($dados["data_sincerity"]);
	if($dados["data_reliability"] == "") 	unset($dados["data_reliability"]);
	if($dados["data_hope"] == "") 			unset($dados["data_hope"]);
	if($dados["data_light"] == "") 			unset($dados["data_light"]);
	if($dados["data_kindness"] == "") 		unset($dados["data_kindness"]);
	if($dados["data_destiny"] == "") 		unset($dados["data_destiny"]);
	if($dados["data_miracles"] == "") 		unset($dados["data_miracles"]);

	$db = new Database();

	$r = $db->insert("vms_specie_has_evolutions", $dados);

	if($r == true) {
		exit("<script>alert('sucesso');location.href='../evolution';</script>");
	}else{
		exit("<script>alert('error');window.history.back();</script>");
	}

?>