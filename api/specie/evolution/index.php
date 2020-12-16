<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json; charset=utf-8');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/data.php");	
	include("../../../class/specie.php");
	include("../../../class/crest.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$return = array();
	$return["success"] = false;

	$monsterId 		= $data["monsterId"];
	$evolutionId 	= $data["evolutionId"];
	$userId 		= $data["userId"];

	if (userHasDataToEvolution($userId, $evolutionId)) {
		if (evolveSpeciesTo($monsterId, $evolutionId)) {
			$return["success"] = true;
			$return["response"] = getMonster($monsterId);
		} else {
			$return["message"] = "Não foi possível evoluir o seu Digimon neste momento. Por favor, tente novamente mais tarde.";
		}
	} else {
		$return["message"] = "Você não possui DigiData suficiente para fazer esta evolução. Por favor, tente novamente quando tiver DigiData disponível.";
	}

	print_r(pretty_json(json_encode($return)));

?>

















