<?

function getRandomPersonality()
{
    $pers = array();
    array_push($pers, "BRAVE");
    array_push($pers, "NAUGHTY");
    array_push($pers, "ADAMANT");
    array_push($pers, "LONELY");

    array_push($pers, "BOLD");
    array_push($pers, "IMPISH");
    array_push($pers, "LAX");
    array_push($pers, "RELAXED");

    array_push($pers, "MODEST");
    array_push($pers, "MILD");
    array_push($pers, "RASH");
    array_push($pers, "QUIET");

    array_push($pers, "CALM");
    array_push($pers, "GENTLE");
    array_push($pers, "CAREFUL");
    array_push($pers, "SASSY");

    array_push($pers, "HASTY");
    array_push($pers, "TIMID");
    array_push($pers, "JOLLY");
    array_push($pers, "NAIVE");

    array_push($pers, "BASHFUL");
    array_push($pers, "DOCILE");
    array_push($pers, "HARDY");
    array_push($pers, "QUIRKY");
    array_push($pers, "SERIOUS");

    $p = rand(0, sizeof($pers) - 1);

    return $pers[$p];
}

function advantage($attacker, $defender)
{
    $van = getAttributeAdvantage($attacker[attribute], $defender[attribute]);

    if ($attacker[type2] == null && $defender[type2] == null) {
        return $van + getTypeAdvantage($attacker[type1], $defender[type1]);
    } else if ($attacker[type2] == null) {
        $adv1 = getTypeAdvantage($attacker[type1], $defender[type1]);
        $adv2 = getTypeAdvantage($attacker[type1], $defender[type2]);
        return $van + $adv1 + $adv2;
    } else if ($defender[type2] == null) {
        $adv1 = getTypeAdvantage($attacker[type1], $defender[type1]);
        $adv2 = getTypeAdvantage($attacker[type2], $defender[type1]);
        return $van + $adv1 + $adv2;
    } else {
        $adv1 = getTypeAdvantage($attacker[type1], $defender[type1]);
        $adv2 = getTypeAdvantage($attacker[type1], $defender[type2]);
        $adv3 = getTypeAdvantage($attacker[type2], $defender[type1]);
        $adv4 = getTypeAdvantage($attacker[type2], $defender[type2]);
        return $van + $adv1 + $adv2 + $adv3 + $adv4;
    }
}

function getAttributeAdvantage($attr1, $attr2)
{
    if ($attr1 == "DATA" && $attr2 == "VACCINE") return 5;
    else if ($attr1 == "VACCINE" && $attr2 == "VIRUS") return 5;
    else if ($attr1 == "VIRUS" && $attr2 == "DATA") return 5;

    else if ($attr2 == "VACCINE" && $attr1 == "VIRUS") return -5;
    else if ($attr2 == "VIRUS" && $attr1 == "DATA") return -5;
    else if ($attr2 == "DATA" && $attr1 == "VACCINE") return -5;

    else return 0;
}

function getTypeAdvantage($type1, $type2)
{
    if ($type1 == "NEUTRAL" || $type2 == "NEUTRAL") return 0;

    else if ($type1 == "WATER" && $type2 == "FIRE") return 5;
    else if ($type1 == "FIRE" && $type2 == "ICE") return 5;
    else if ($type1 == "ICE" && $type2 == "LIGHT") return 5;
    else if ($type1 == "LIGHT" && $type2 == "DARK") return 5;
    else if ($type1 == "DARK" && $type2 == "THUNDER") return 5;
    else if ($type1 == "THUNDER" && $type2 == "STEEL") return 5;
    else if ($type1 == "STEEL" && $type2 == "WIND") return 5;
    else if ($type1 == "WIND" && $type2 == "GROUND") return 5;
    else if ($type1 == "GROUND" && $type2 == "WOOD") return 5;
    else if ($type1 == "WOOD" && $type2 == "WATER") return 5;

    else if ($type2 == "WATER" && $type1 == "FIRE") return -5;
    else if ($type2 == "FIRE" && $type1 == "ICE") return -5;
    else if ($type2 == "ICE" && $type1 == "LIGHT") return -5;
    else if ($type2 == "LIGHT" && $type1 == "DARK") return -5;
    else if ($type2 == "DARK" && $type1 == "THUNDER") return -5;
    else if ($type2 == "THUNDER" && $type1 == "STEEL") return -5;
    else if ($type2 == "STEEL" && $type1 == "WIND") return -5;
    else if ($type2 == "WIND" && $type1 == "GROUND") return -5;
    else if ($type2 == "GROUND" && $type1 == "WOOD") return -5;
    else if ($type2 == "WOOD" && $type1 == "WATER") return -5;

    else return 0;
}

function assertHouseyStats($mon, $house)
{
    if ($house == "Yellow Angels") {
        $mon[hp] = more10percent($mon[hp]);
        $mon[atk] = more10percent($mon[atk]);
        $mon[def] = more10percent($mon[def]);
        $mon[spatk] = more10percent($mon[spatk]);
        $mon[spdef] = more10percent($mon[spdef]);
        $mon[spd] = more10percent($mon[spd]);
    } else if ($house == "Blue Wolfs") {
        $mon[hp] = more20percent($mon[hp]);
        $mon[atk] = more20percent($mon[atk]);
        $mon[def] = more20percent($mon[def]);
        $mon[spatk] = more20percent($mon[spatk]);
        $mon[spdef] = more20percent($mon[spdef]);
        $mon[spd] = more20percent($mon[spd]);
    }

    return $mon;
}

function assertPersonalityStats($mon, $pers)
{
    if ($pers == "BRAVE" ||
        $pers == "NAUGHTY" ||
        $pers == "ADAMANT" ||
        $pers == "LONELY") {
        $mon[atk] = more10percent($mon[atk]);
    } else if ($pers == "BOLD" ||
        $pers == "IMPISH" ||
        $pers == "LAX" ||
        $pers == "RELAXED") {
        $mon[def] = more10percent($mon[def]);
    } else if ($pers == "MODEST" ||
        $pers == "MILD" ||
        $pers == "RASH" ||
        $pers == "QUIET") {
        $mon[spatk] = more10percent($mon[spatk]);
    } else if ($pers == "CALM" ||
        $pers == "GENTLE" ||
        $pers == "CAREFUL" ||
        $pers == "SASSY") {
        $mon[spdef] = more10percent($mon[spdef]);
    } else if ($pers == "HASTY" ||
        $pers == "TIMID" ||
        $pers == "JOLLY" ||
        $pers == "NAIVE") {
        $mon[spd] = more10percent($mon[spd]);
    }

    if ($pers == "BOLD" ||
        $pers == "MODEST" ||
        $pers == "CALM" ||
        $pers == "TIMID") {
        $mon[atk] = less10percent($mon[atk]);
    } else if ($pers == "LONELY" ||
        $pers == "MILD" ||
        $pers == "GENTLE" ||
        $pers == "HASTY") {
        $mon[def] = less10percent($mon[def]);
    } else if ($pers == "ADAMANT" ||
        $pers == "IMPISH" ||
        $pers == "CAREFUL" ||
        $pers == "JOLLY") {
        $mon[spatk] = less10percent($mon[spatk]);
    } else if ($pers == "NAUGHTY" ||
        $pers == "LAX" ||
        $pers == "RASH" ||
        $pers == "NAIVE") {
        $mon[spdef] = less10percent($mon[spdef]);
    } else if ($pers == "BRAVE" ||
        $pers == "RELAXED" ||
        $pers == "QUIET" ||
        $pers == "SASSY") {
        $mon[spd] = less10percent($mon[spd]);
    }

    return $mon;
}

function more10percent($value)
{
    return intval($value + ($value * 10 / 100));
}

function less10percent($value)
{
    return intval($value - ($value * 10 / 100));
}

function more20percent($value)
{
    return intval($value + ($value * 20 / 100));
}

function less20percent($value)
{
    return intval($value - ($value * 20 / 100));
}

function getSpecieEvolution($evolutionId)
{
    $db = new Database();

    $return = array();

    $r = $db->select("vms_specie_has_evolutions", "WHERE id = '$evolutionId'");
    $return = mysqli_fetch_array($r, MYSQLI_ASSOC);

    return $return;
}

function getEvolutions($monsterId)
{
    $specie = getSpecieFromMonster($monsterId);
    $monster = getMonster($monsterId);

    $db = new Database();

    $return = array();

    $r = $db->select("vms_active_evolutions", "WHERE previous = '" . $specie["id"] . "'");
    while ($e = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

        $e["image"] = "http://api.vmonsters.com/assets/species/" . $e["image"];

        $e["canEvolve"] = userHasDataToEvolution($monster["user"], $e["id"]);

        $e["datas"] = array();

        if ($e["data_neutral"] != null) {
            $data = array();
            $data["count"] = $e["data_neutral"];
            $data["crest"] = getCrest(0);
            array_push($e["datas"], $data);
        }

        if ($e["data_courage"] != null) {
            $data = array();
            $data["count"] = $e["data_courage"];
            $data["crest"] = getCrest(1);
            array_push($e["datas"], $data);
        }

        if ($e["data_friendship"] != null) {
            $data = array();
            $data["count"] = $e["data_friendship"];
            $data["crest"] = getCrest(2);
            array_push($e["datas"], $data);
        }

        if ($e["data_love"] != null) {
            $data = array();
            $data["count"] = $e["data_love"];
            $data["crest"] = getCrest(3);
            array_push($e["datas"], $data);
        }

        if ($e["data_knowledge"] != null) {
            $data = array();
            $data["count"] = $e["data_knowledge"];
            $data["crest"] = getCrest(4);
            array_push($e["datas"], $data);
        }

        if ($e["data_sincerity"] != null) {
            $data = array();
            $data["count"] = $e["data_sincerity"];
            $data["crest"] = getCrest(5);
            array_push($e["datas"], $data);
        }

        if ($e["data_reliability"] != null) {
            $data = array();
            $data["count"] = $e["data_reliability"];
            $data["crest"] = getCrest(6);
            array_push($e["datas"], $data);
        }

        if ($e["data_hope"] != null) {
            $data = array();
            $data["count"] = $e["data_hope"];
            $data["crest"] = getCrest(7);
            array_push($e["datas"], $data);
        }

        if ($e["data_light"] != null) {
            $data = array();
            $data["count"] = $e["data_light"];
            $data["crest"] = getCrest(8);
            array_push($e["datas"], $data);
        }

        if ($e["data_kindness"] != null) {
            $data = array();
            $data["count"] = $e["data_kindness"];
            $data["crest"] = getCrest(9);
            array_push($e["datas"], $data);
        }

        if ($e["data_destiny"] != null) {
            $data = array();
            $data["count"] = $e["data_destiny"];
            $data["crest"] = getCrest(10);
            array_push($e["datas"], $data);
        }

        if ($e["data_miracles"] != null) {
            $data = array();
            $data["count"] = $e["data_miracles"];
            $data["crest"] = getCrest(11);
            array_push($e["datas"], $data);
        }

        unset($e["previous"]);
        unset($e["data_neutral"]);
        unset($e["data_courage"]);
        unset($e["data_friendship"]);
        unset($e["data_love"]);
        unset($e["data_knowledge"]);
        unset($e["data_sincerity"]);
        unset($e["data_reliability"]);
        unset($e["data_hope"]);
        unset($e["data_light"]);
        unset($e["data_kindness"]);
        unset($e["data_destiny"]);
        unset($e["data_miracles"]);
        unset($e["item"]);

        array_push($return, $e);
    }

    return $return;
}

function getEvolutionsBySpecie($specieId)
{

    $db = new Database();

    $return = array();

    $r = $db->select("vms_active_evolutions", "WHERE previous = '$specieId'");
    while ($e = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

        $e["image"] = "http://api.vmonsters.com/assets/species/" . $e["image"];

        $e["datas"] = array();

        if ($e["data_neutral"] != null) {
            $data = array();
            $data["count"] = $e["data_neutral"];
            $data["crest"] = getCrest(0);
            array_push($e["datas"], $data);
        }

        if ($e["data_courage"] != null) {
            $data = array();
            $data["count"] = $e["data_courage"];
            $data["crest"] = getCrest(1);
            array_push($e["datas"], $data);
        }

        if ($e["data_friendship"] != null) {
            $data = array();
            $data["count"] = $e["data_friendship"];
            $data["crest"] = getCrest(2);
            array_push($e["datas"], $data);
        }

        if ($e["data_love"] != null) {
            $data = array();
            $data["count"] = $e["data_love"];
            $data["crest"] = getCrest(3);
            array_push($e["datas"], $data);
        }

        if ($e["data_knowledge"] != null) {
            $data = array();
            $data["count"] = $e["data_knowledge"];
            $data["crest"] = getCrest(4);
            array_push($e["datas"], $data);
        }

        if ($e["data_sincerity"] != null) {
            $data = array();
            $data["count"] = $e["data_sincerity"];
            $data["crest"] = getCrest(5);
            array_push($e["datas"], $data);
        }

        if ($e["data_reliability"] != null) {
            $data = array();
            $data["count"] = $e["data_reliability"];
            $data["crest"] = getCrest(6);
            array_push($e["datas"], $data);
        }

        if ($e["data_hope"] != null) {
            $data = array();
            $data["count"] = $e["data_hope"];
            $data["crest"] = getCrest(7);
            array_push($e["datas"], $data);
        }

        if ($e["data_light"] != null) {
            $data = array();
            $data["count"] = $e["data_light"];
            $data["crest"] = getCrest(8);
            array_push($e["datas"], $data);
        }

        if ($e["data_kindness"] != null) {
            $data = array();
            $data["count"] = $e["data_kindness"];
            $data["crest"] = getCrest(9);
            array_push($e["datas"], $data);
        }

        if ($e["data_destiny"] != null) {
            $data = array();
            $data["count"] = $e["data_destiny"];
            $data["crest"] = getCrest(10);
            array_push($e["datas"], $data);
        }

        if ($e["data_miracles"] != null) {
            $data = array();
            $data["count"] = $e["data_miracles"];
            $data["crest"] = getCrest(11);
            array_push($e["datas"], $data);
        }

        unset($e["previous"]);
        unset($e["data_neutral"]);
        unset($e["data_courage"]);
        unset($e["data_friendship"]);
        unset($e["data_love"]);
        unset($e["data_knowledge"]);
        unset($e["data_sincerity"]);
        unset($e["data_reliability"]);
        unset($e["data_hope"]);
        unset($e["data_light"]);
        unset($e["data_kindness"]);
        unset($e["data_destiny"]);
        unset($e["data_miracles"]);
        unset($e["item"]);

        array_push($return, $e);
    }

    return $return;
}

function getPrevolutionsBySpecie($specieId)
{

    $db = new Database();

    $return = array();

    $r = $db->select("vms_active_prevolution", "WHERE evolution = '$specieId'");
    while ($e = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

        $e["image"] = "http://api.vmonsters.com/assets/species/" . $e["image"];

        unset($e["evolution"]);

        array_push($return, $e);
    }

    return $return;
}

function evolveSpeciesTo($monsterId, $evolutionId)
{
    $db = new Database();

    $evolution = getSpecieEvolution($evolutionId);
    $specie = getSpecieFromMonster($monsterId);

    if ($specie["id"] == $evolution["specie"]) {
        $userSpecie = getUserSpecie($monsterId);
        $userSpecie["specie"] = $evolution["evolution"];

        if ($userSpecie["name"] == $specie["name"]) {
            $evolutionSpecies = getSpecie($evolution["evolution"]);
            $userSpecie["name"] = $evolutionSpecies["name"];
        }
        $r = $db->update("vms_user_has_species", $userSpecie);

        if ($r == true) {
            $r = $db->insert("vms_monster_has_step", array("monster" => $monsterId, "specie" => $userSpecie["specie"]));
            return discountDigiDataFromEvolution($userSpecie["user"], $evolutionId);
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getStepsFromMonster($monsterId)
{
    $db = new Database();

    $monsters = array();

    $r = $db->select("vms_active_steps", "WHERE monster = '$monsterId'");
    while ($m = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        unset($m["id"]);
        unset($m["monster"]);
        $m["image"] = "http://api.vmonsters.com/assets/species/" . $m["image"];
        array_push($monsters, $m);
    }

    return $monsters;
}

function userHasDataToEvolution($userId, $evolutionId)
{
    $evolution = getSpecieEvolution($evolutionId);

    if ($evolution["data_neutral"] != null) {
        $data = getUserDataCount($userId, 0);

        if ($evolution["data_neutral"] > $data) return false;
    }

    if ($evolution["data_courage"] != null) {
        $data = getUserDataCount($userId, 1);

        if ($evolution["data_courage"] > $data) return false;
    }

    if ($evolution["data_friendship"] != null) {
        $data = getUserDataCount($userId, 2);

        if ($evolution["data_friendship"] > $data) return false;
    }

    if ($evolution["data_love"] != null) {
        $data = getUserDataCount($userId, 3);

        if ($evolution["data_love"] > $data) return false;
    }

    if ($evolution["data_knowledge"] != null) {
        $data = getUserDataCount($userId, 4);

        if ($evolution["data_knowledge"] > $data) return false;
    }

    if ($evolution["data_sincerity"] != null) {
        $data = getUserDataCount($userId, 5);

        if ($evolution["data_sincerity"] > $data) return false;
    }

    if ($evolution["data_reliability"] != null) {
        $data = getUserDataCount($userId, 6);

        if ($evolution["data_reliability"] > $data) return false;
    }

    if ($evolution["data_hope"] != null) {
        $data = getUserDataCount($userId, 7);

        if ($evolution["data_hope"] > $data) return false;
    }

    if ($evolution["data_light"] != null) {
        $data = getUserDataCount($userId, 8);

        if ($evolution["data_light"] > $data) return false;
    }

    if ($evolution["data_kindness"] != null) {
        $data = getUserDataCount($userId, 9);

        if ($evolution["data_kindness"] > $data) return false;
    }

    if ($evolution["data_destiny"] != null) {
        $data = getUserDataCount($userId, 10);

        if ($evolution["data_destiny"] > $data) return false;
    }

    if ($evolution["data_miracles"] != null) {
        $data = getUserDataCount($userId, 11);

        if ($evolution["data_miracles"] > $data) return false;
    }

    return true;

}

function getUserSpecie($monsterId)
{
    $db = new Database();

    $r = $db->select("vms_user_has_species", "WHERE id = '$monsterId'");
    $species = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($species == null) return null;

    return $species;
}

function getSpecie($specieId)
{
    $db = new Database();

    $r = $db->select("vms_species", "WHERE id = '$specieId'");
    $species = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($species == null) return null;

    return $species;
}

function getSpecieFromMonster($monsterId)
{
    $monster = getMonster($monsterId);

    $db = new Database();

    $r = $db->select("vms_species", "WHERE name = '" . $monster["specie"] . "'");
    $species = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($species == null) return null;

    return $species;
}

function getSpecieIdFromMonster($monsterId)
{
    $species = getSpecieFromMonster($monsterId);

    if ($species == null) return null;

    return $species["id"];
}

function getBuddy($userId, $shortVersion = false)
{
    $db = new Database();

    if ($shortVersion == false) {
        $monster = $db->selectObject("vms_active_monsters", "WHERE user = '$userId' AND isBuddy = '1'");
    } else {
        $monster = $db->sqlObject("SELECT image FROM vms_active_monsters WHERE user = '$userId' AND isBuddy = '1'");
    }

    if ($monster == null) return null;

    return processMonster($monster, $shortVersion);
}

function getMonster($monsterId)
{
    $db = new Database();

    $monster = $db->selectObject("vms_active_monsters", "WHERE id = '$monsterId'");

    if ($monster == null) return null;

    return processMonster($monster);
}

function getMonsters($userId)
{
    $db = new Database();

    $monsters = $db->selectArray("vms_active_monsters", "WHERE user = '$userId'");

    if ($monsters == null) return null;

    $processedMonsters = array();
    foreach ($monsters as $monster) {
        array_push($processedMonsters, processMonster($monster));
    }

    return $processedMonsters;

}

function processMonster($monster, $shortVersion = false)
{
    //$monster["description"] = mb_convert_encoding($monster["description"], "ISO-8859-1");

    $monster["image"] = "http://api.vmonsters.com/assets/species/" . $monster["image"];

    if ($shortVersion == false) {
        $newMonster = $monster;

        $newMonster["steps"] = getStepsFromMonster($newMonster["id"]);

        $newMonster = assertPersonalityStats($newMonster, $newMonster[personality]);

        $newMonster[baseHp] = $monster[hp];
        $newMonster[baseAtk] = $monster[atk];
        $newMonster[baseDef] = $monster[def];
        $newMonster[baseSpAtk] = $monster[spatk];
        $newMonster[baseSpDef] = $monster[spdef];
        $newMonster[baseSpd] = $monster[spd];

        $newMonster[hp] = $monster[hp] + intval($monster[euHp] / 4);
        $newMonster[atk] = $monster[atk] + intval($monster[euAtk] / 4);
        $newMonster[def] = $monster[def] + intval($monster[euDef] / 4);
        $newMonster[spatk] = $monster[spatk] + intval($monster[euSpAtk] / 4);
        $newMonster[spdef] = $monster[spdef] + intval($monster[euSpDef] / 4);
        $newMonster[spd] = $monster[spd] + intval($monster[euSpd] / 4);

        $newMonster[hp] = $monster[hp] * 5;
    } else {
        $newMonster["image"] = $monster["image"];
    }

    return $newMonster;
}

function getStandAloneMonster($specieId, $personality)
{
    $db = new Database();

    $r = $db->select("vms_species", "WHERE id = '$specieId'");
    $monster = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($monster == null) return null;

    $monster["description"] = mb_convert_encoding($monster["description"], "ISO-8859-1");

    $monster["image"] = "http://api.vmonsters.com/assets/species/" . $monster["image"];

    $monster["personality"] = $personality;

    $monster = assertPersonalityStats($monster, $monster[personality]);

    $monster[hp] = $monster[hp] * 5;

    return $monster;
}

?>