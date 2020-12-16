<?
	session_start();

	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set("America/Recife");

	include("../../class/connection.php");
	include("../../class/database.php");
	include("../../class/log.php");

	$dados = array();
	$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	unset($dados["CADASTRAR"]);

	if($_FILES['image']['name'] != ""){
		$array = explode('.', $_FILES['image']['name']);
		$ext = end($array);

		$image = date("YmdHis").".".$ext;
	
		$destino = '../../assets/species/'.$image;
	 
		$arquivo_tmp = $_FILES['image']['tmp_name'];
	 
		move_uploaded_file($arquivo_tmp, $destino);

		$dados["image"] = $image;

		unlink($dados["aimage"]);
	}else{
		unset($dados["image"]);
	}
	
	unset($dados["aimage"]);

	if($dados["type2"] == "NONE") $dados["type2"] = null;

	$db = new Database();

	$r = $db->update("vms_species", $dados);

	if($r == true) {
		log_activity($_SESSION[vms_user], "Editou os dados de um Digimon: $dados[name]");
		exit("<script>location.href='../dashboard?o=ee&i=$dados[id]&m=s';</script>");
	}else{
		exit("<script>location.href='../dashboard?o=ee&i=$dados[id]&m=e';</script>");
	}

?>