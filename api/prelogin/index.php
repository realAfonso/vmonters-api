<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include("../../class/pretty_json.php");

	//$thisMomentMessage = "Estamos passando por instabilidades, e por este motivo o login está desativado no momento. Pedimos desculpas e devemos retornar dentro de 1 hora.";

	//$oldVersionMessage = "Pedimos desculpas, mas a última atualização foi tão grande que se permitíssemos sua entrada no app ele iria quebrar. Por este motívo pedimos encarecidamente que procure a atualização na Playstore.";
	//$oldVersionMessage = "Pedimos desculpas, mas a última atualização continha bugs que afetavam a gameplay. Por este motívo pedimos encarecidamente que procure a atualização mais recente na Playstore.";


	$return = array();
	$return["success"] = true;
	$return["response"] = array(
		"lastVersion" => "0.7.3",
		"canLoginOnOldVersion" => true,
		"canLoginInThisMoment" => true,
		"thisMomentMessage" => $thisMomentMessage,
		"oldVersionMessage" => $oldVersionMessage
	);


	print_r(pretty_json(json_encode($return)));

?>