<?

ini_set("memory_limit", "500M");
header('Content-type: application/json;');
date_default_timezone_set("America/Recife");

include("../../../class/pretty_json.php");
include("../../../class/connection.php");
include("../../../class/database.php");
include("../../../class/date.php");

$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

$return = array();

$db = new Database();

$userId = $data[userId];
$charId = $data[charId];

$char = $db->selectObject("vms_chars", "WHERE id = '$charId'");

if (!empty($char)) {

    $return[success] = true;
    $return[response] = array(
        "name" => $char[name],
        "image" => getImage($char[image]),
        "text" => $char[defaultText],
        "actionType" => "END"
    );

} else {
    $return[success] = false;
    $return[message] = "Personagem selecionado não existe...";
}


print_r(pretty_json(json_encode($return)));

function getImage($image)
{
    return "http://api.vmonsters.com/assets/chars/$image";
}