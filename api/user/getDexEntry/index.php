<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json;');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/specie.php");
	include("../../../class/data.php");	
	include("../../../class/crest.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$species = array();

	$specie = $db->selectObject("vms_species", "WHERE id = '$data[specieId]'");
	$specie[baseHp] = $specie[hp];
	$specie[hp] = $specie[hp] * 5;
	$specie["image"] = "http://api.vmonsters.com/assets/species/".$specie["image"];
	unset($specie[orderr]);

	$v = $db->select("vms_active_steps", "WHERE user = '$data[userId]' AND specie = '$specie[id]' LIMIT 1");
	$uhs = mysqli_fetch_array($v, MYSQLI_ASSOC);

	if ($uhs == null) {
		$specie["userHasSpecie"] = false;
	} else {
		$specie["userHasSpecie"] = true;
	}

	$specie["prevolutions"] = getPrevolutionsBySpecie($specie["id"]);
	$specie["evolutions"] = getEvolutionsBySpecie($specie["id"]);

	$return["success"] = true;
	$return["response"] = $specie;

	print_r(pretty_json(json_encode($return)));

?>