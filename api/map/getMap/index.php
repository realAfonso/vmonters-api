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
$mapId = 0;

if (empty($data[mapId])) {
    $mapId = 1;
} else {
    $mapId = $data[mapId];
}

$map = $db->selectObject("vms_maps", "WHERE id = '$mapId'");

if (!empty($map)) {

    $user = $db->selectObject("vms_users", "WHERE id = '$userId'");
    $user[map] = $mapId;
    $db->update("vms_users", $user);

    $return[success] = true;
    $return[response] = array(
        "id" => $map[id],
        "name" => $map[name],
        "keyy" => $map[keyy],
        "type" => getMapType($map[type])
    );

    if ($map[type] == 1) {
        if (isDay()) {
            $return[response][mapBackground] = getMapground($map[imageDay]);
            $return[response][storyBackground] = getBackground($map[storyDay]);
        } else {
            $return[response][mapBackground] = getMapground($map[imageNight]);
            $return[response][storyBackground] = getBackground($map[storyNight]);
        }
    } else {
        $return[response][mapBackground] = getMapground($map[imageInteral]);
        $return[response][storyBackground] = getBackground($map[storyInternal]);
    }

    $return[response][fields] = getFields($mapId);
} else {
    $return[success] = false;
    $return[message] = "Mapa selecionado não existe...";
}


print_r(pretty_json(json_encode($return)));

function getFields($mapId)
{
    $db = new Database();
    $mhps = $db->selectArray("vms_map_has_place", "WHERE map = '$mapId'");

    $places = array();
    foreach ($mhps as $mhp) {
        if (($mhp[visibility] == 1) || ($mhp[visibility] == 2 && !isDay()) || ($mhp[visibility] == 3 && isDay())) {
            if($mhp[type] == "MAP") {
                $p = $db->selectObject("vms_maps", "WHERE id = '$mhp[actionId]'");
                $place = array(
                    "id" => $p[id],
                    "name" => $p[name],
                    "pointType" => $mhp[type],
                    "icon" => getIcon($p[imageIcon], $mhp[icon]),
                    "field" => $mhp[field]
                );
                array_push($places, $place);
            }else{
                $p = $db->selectObject("vms_chars", "WHERE id = '$mhp[actionId]'");
                $place = array(
                    "id" => $p[id],
                    "name" => $p[name],
                    "pointType" => $mhp[type],
                    "icon" => getCharIcon($p[icon]),
                    "field" => $mhp[field]
                );
                array_push($places, $place);
            }
        }
    }

    return $places;
}

function getIcon($image, $customImage)
{
    if (!empty($customImage)) {
        return "http://api.vmonsters.com/assets/mapgrounds/$customImage";
    } else {
        return "http://api.vmonsters.com/assets/mapgrounds/$image";
    }
}

function getCharIcon($image)
{
    return "http://api.vmonsters.com/assets/charicons/$image";
}

function getBackground($image)
{
    return "http://api.vmonsters.com/assets/backgrounds/$image";
}

function getMapground($image)
{
    return "http://api.vmonsters.com/assets/mapgrounds/$image";
}

function getMapType($type)
{
    if ($type == 1) return "EXTERNAL";
    else if ($type == 2) return "INTERNAL";
    else return "ROOM";
}