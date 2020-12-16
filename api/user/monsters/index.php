<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json;');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/specie.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();

	$species = array();

	$r = $db->select("vms_active_monsters", " WHERE user = '".$data["i"]."'");
	
	while($s = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		$s = getMonster($s["id"]);
		array_push($species, $s);
	}

	$return["success"] = true;
	$return["response"] = $species;

	print_r(pretty_json(json_encode($return)));

?>