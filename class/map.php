<?php

function getMap($mapId)
{
    $db = new Database();
    return $db->selectObject("vms_maps", "WHERE id = '$mapId'");
}

function getMapTemplate($mapId)
{
    $map = getMap($mapId);

    if ($map[type] == 1) {
        if (isDay()) {
            return getMapBackground($map[storyDay]);
        } else {
            return getMapBackground($map[storyNight]);
        }
    } else {
        return getMapBackground($map[storyInternal]);
    }
}

function getMapBackground($image)
{
    return "http://api.vmonsters.com/assets/backgrounds/$image";
}

function getMapMapground($image)
{
    return "http://api.vmonsters.com/assets/mapgrounds/$image";
}

function getMapType($type)
{
    if ($type == 1) return "EXTERNAL";
    else if ($type == 2) return "INTERNAL";
    else return "ROOM";
}