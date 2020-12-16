<?

	ini_set("memory_limit","500M");
	header('Content-type: application/json');

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");

	$return = array();

	$db = new Database();

	$news = array();

	$r = $db->select("vms_news", "WHERE (start <= '".time()."' AND end >= '".time()."') OR (start = '0' AND end = '0') ORDER BY id DESC");
	
	while($s = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		$s["simage"] = "http://api.vmonsters.com/assets/banners/".$s["simage"];
		$s["nimage"] = "http://api.vmonsters.com/assets/news/".$s["nimage"];
		unset($s["showOnStore"]);
		unset($s["start"]);
		unset($s["end"]);
		array_push($news, $s);
	}

	$return["success"] = true;
	$return["response"] = $news;

	print_r(pretty_json(json_encode($return)));

?>