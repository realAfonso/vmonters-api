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

	$r = $db->select("vms_species", "ORDER BY orderr ASC, name ASC");
	
	while($s = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		$s[baseHp] = $s[hp];
		$s[hp] = $s[hp] * 5;
		$s["image"] = "http://api.vmonsters.com/assets/species/".$s["image"];
		unset($s[orderr]);

		$v = $db->select("vms_active_steps", "WHERE user = '$data[userId]' AND specie = '$s[id]' LIMIT 1");
		$uhs = mysqli_fetch_array($v, MYSQLI_ASSOC);

		if ($uhs == null) {
			$s["userHasSpecie"] = false;
		} else {
			$s["userHasSpecie"] = true;
		}

		$s["prevolutions"] = getPrevolutionsBySpecie($s["id"]);
		$s["evolutions"] = getEvolutionsBySpecie($s["id"]);

		array_push($species, $s);
	}

	$return["success"] = true;
	$return["response"] = $species;

	print_r(pretty_json(json_encode($return)));

?>