<?

	date_default_timezone_set("America/Sao_Paulo");

	$time_hoje = time();
	$date_hoje = date("Y-m-d");

	echo $time_hoje."<br><br>".$date_hoje."<br><br>";

	$date_ontem = date("Y-m-d", strtotime($date_hoje." - 1 days"));

	$ante_ontem = date("Y-m-d", strtotime($date_hoje." - 2 days"));



	echo "ontem: ".strtotime($date_ontem)."<br><br>";
	echo "anteontem: ".strtotime($ante_ontem)."<br><br>";




?>