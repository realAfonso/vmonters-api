<?

	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set("America/Recife");

	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/push.php");

	$dados = array();
	$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	unset($dados["CADASTRAR"]);

	if($_FILES['simage']['name'] != ""){
		$array = explode('.', $_FILES['simage']['name']);
		$ext = end($array);

		$simage = date("YmdHis").".".$ext;
	
		$destino = '../../../assets/banners/'.$simage;
	 
		$arquivo_tmp = $_FILES['simage']['tmp_name'];
	 
		move_uploaded_file($arquivo_tmp, $destino);

		$dados["simage"] = $simage;
	}

	if($_FILES['nimage']['name'] != ""){
		$array = explode('.', $_FILES['nimage']['name']);
		$ext = end($array);

		$nimage = date("YmdHis").".".$ext;
	
		$destino = '../../../assets/news/'.$nimage;
	 
		$arquivo_tmp = $_FILES['nimage']['tmp_name'];
	 
		move_uploaded_file($arquivo_tmp, $destino);

		$dados["nimage"] = $nimage;
	}

	if($dados["start"] != "") $dados["start"] = strtotime($dados["start"]);
	if($dados["end"] != "") $dados["end"] = strtotime($dados["end"]);

	$db = new Database();

	$r = $db->insert("vms_news", $dados);

	if($dados["start"] <= time()){

		$dados = array(
			"title" => $dados["title"],
			"message" => "Acesse a área de novidades do app e saiba mais!",
			"image" => "http://api.vmonsters.com/assets/banners/".$dados["simage"],
			"android" => true
		);

		preparePush($dados);
	}

	if($r > 0) {
		exit("<script>alert('sucesso');location.href='../create';</script>");
	}else{
		exit("<script>alert('error');window.history.back();</script>");
	}

?>