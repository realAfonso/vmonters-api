<?

ini_set("memory_limit", "500M");
header('Content-type: application/json;');
date_default_timezone_set("America/Recife");

include("../../../class/pretty_json.php");
include("../../../class/connection.php");
include("../../../class/database.php");
include("../../../class/log.php");

$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

$return = array();

$db = new Database();

$userId = $data[userId];
$location = $data[location];

log_activity($userId, "Visualizando lista de objetivos");

if (empty($location)) $location = "pt-BR";

$uhk = $db->selectArray("view_user_has_keywords", "WHERE user = '$userId' AND language = '$location'");

$return[success] = true;
$return[response] = array();

foreach ($uhk as $value) {
    array_push($return[response], array(
        "id" => $value[id],
        "label" => $value[label],
        "target" => $value[target]
    ));
}

print_r(pretty_json(json_encode($return)));
