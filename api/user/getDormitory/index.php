<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");
	include("../../../class/crest.php");
	include("../../../class/friends.php");
	include("../../../class/specie.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$return = array();

	$db = new Database();
	$us = new User();

	$userHouse = getUserHouse($data["userId"]);

	$people = array();

	$r = $db->select("vms_active_users", "WHERE house = '$userHouse' AND id != '$data[userId]' ORDER BY lastLogin DESC LIMIT 200");

	while($f = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		$person = array();
		$person["id"] = $f["id"];
		$person["name"] = $f["name"];
		$person["avatar"] = "http://api.vmonsters.com/assets/avatars/".$f["avatar"];
		$person["buddy"] = getBuddy($f["id"], true);
		$person["crest"] = getCrest($f["crest"]);
		$person["isFriend"] = isFriend($data["userId"], $f["id"]);
		$person["badge"] = getUserBadge($f["vip"], $f["type"]);

		array_push($people, $person);
	}

	$return["success"] = true;
	$return["response"] = $people;

	print_r(pretty_json(json_encode($return)));

?>