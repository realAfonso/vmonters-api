<?

ini_set("memory_limit", "500M");
header('Content-type: application/json');
date_default_timezone_set("America/Recife");

include("../../../class/pretty_json.php");
include("../../../class/connection.php");
include("../../../class/database.php");
include("../../../class/log.php");
include("../../../class/date.php");
include("../../../class/push.php");
include("../../../class/user.php");
include("../../../class/specie.php");
include("../../../class/crest.php");

$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

$return = array();

$db = new Database();

$users = $db->selectArray("vms_user_has_valor", " WHERE user != '$data[userId]' AND floor = '$data[floor]'");

if (sizeof($users) == 0) {
    $return["success"] = false;
    $return["message"] = "Ainda não existem outros jogadores no mesmo andar que você para batalhar.";
} else {
    $size = sizeof($users);
    $rand = rand(0, $size - 1);
    $oppo = $users[$rand];

    $return["success"] = true;
    $return[response] = array();

    $challenger = getUser($data[userId]);
    $opponent = getUser($oppo[user]);

    $c1 = $challenger[buddy];
    $c2 = $opponent[buddy];

    $return[response][challenger] = $challenger;
    $return[response][opponent] = $opponent;

    $ad1 = advantage($c1, $c2);
    $ad2 = advantage($c2, $c1);

    $mon1 = array();
    $mon2 = array();

    $adv1 = 0;
    $adv2 = 0;

    $hp1 = 0;
    $hp2 = 0;

    $mon1desc = "";
    $mon2desc = "";

    if ($c1[spd] > $c2[spd]) {
        $mon1 = $c1;
        $mon2 = $c2;
        $hp1 = $c1[hp];
        $hp2 = $c2[hp];
        $adv1 = $ad1;
        $adv2 = $ad2;
        $mon1desc = "CHALLENGER";
        $mon2desc = "OPPONENT";
    } else {
        $mon1 = $c2;
        $mon2 = $c1;
        $hp1 = $c2[hp];
        $hp2 = $c1[hp];
        $adv1 = $ad2;
        $adv2 = $ad1;
        $mon2desc = "CHALLENGER";
        $mon1desc = "OPPONENT";
    }

    $return[response]["steps"] = array();

    $bits = 0;

    while ($mon1[hp] > 0 && $mon2[hp] > 0) {
        $hp2 = $mon2[hp];
        $mon2 = atack($mon1, $adv1, $mon2);

        $dam = $hp2 - $mon2[hp];

        $step = array();
        $step[attacker] = $mon1desc;
        $step[damage] = $dam;

        $bits = $bits + $dam;

        array_push($return[response][steps], $step);

        if ($mon2[hp] > 0) {
            $hp1 = $mon1[hp];
            $mon1 = atack($mon2, $adv2, $mon1);

            $dam = $hp1 - $mon1[hp];

            $step = array();
            $step[attacker] = $mon2desc;
            $step[damage] = $dam;

            $bits = $bits + $dam;

            array_push($return[response][steps], $step);
        }

    }

    if ($mon1[hp] > 0) $return[response][winner] = $mon1desc;
    else $return[response][winner] = $mon2desc;

    $userc = $db->selectObject("vms_user_has_valor", " WHERE user = '$data[userId]'");
    $usero = $db->selectObject("vms_user_has_valor", " WHERE user = '$oppo[user]'");

    $currentFloor = $data[floor];

    $currentPoints = 10;

    for ($i = 2; $i <= $currentFloor; $i++) {
        $currentPoints = $currentPoints * 2;
    }

    if ($return[response][winner] == "CHALLENGER") {
        log_activity($challenger[id], "Ganhou uma batalha na Tower of Valor ($data[floor]º andar)");
        getEffortUpgradeWin($challenger[buddy]);
        getEffortUpgradeLoss($opponent[buddy]);

        $userc[allBattles] = $userc[allBattles] + 1;
        $userc[allVictories] = $userc[allVictories] + 1;
        $userc[weekVictories] = $userc[weekVictories] + 1;
        $userc[points] = $userc[points] + 3;
        $userc[battleTickets] = $userc[battleTickets] - 1;

        $usero[allBattles] = $usero[allBattles] + 1;
        $usero[allLooses] = $usero[allLooses] + 1;
        $usero[points] = $usero[points] - 1;

        $return[response][bits] = intval($bits * 90 / 100);
        $return[response][wallet] = intval($currentPoints * 5);

        $filter = array(
            "field" => "tag",
            "key" => "user",
            "relation" => "=",
            "value" => $opponent[id]
        );

        $dados = array(
            "title" => "Seu Digimon perdeu uma batalha!",
            "message" => "$challenger[name] ganhou de você na Tower of Valor, e você perdeu 1 ponto por causa disso :(",
            "filter" => $filter,
            "android" => true,
            "group" => "Tower of Valor Perdeu"
        );

        preparePush($dados);
    } else {
        log_activity($challenger[id], "Perdeu uma batalha na Tower of Valor ($data[floor]º andar)");
        getEffortUpgradeWin($opponent[buddy]);
        getEffortUpgradeLoss($challenger[buddy]);

        $userc[allBattles] = $userc[allBattles] + 1;
        $userc[allLooses] = $userc[allLooses] + 1;
        $userc[points] = $userc[points] - 1;
        $userc[battleTickets] = $userc[battleTickets] - 1;

        $usero[allBattles] = $usero[allBattles] + 1;
        $usero[allVictories] = $usero[allVictories] + 1;
        $usero[weekVictories] = $usero[weekVictories] + 1;
        $usero[points] = $usero[points] + 2;

        $return[response][bits] = intval($bits * 10 / 100);
        $return[response][wallet] = intval(0);

        $money = (($currentPoints * 5) / 2);
        $opponent[wallet] = $opponent[wallet] + $money;
        $db->update("vms_users", array(
            "id" => $opponent[id],
            "wallet" => $opponent[wallet]
        ));

        $filter = array(
            "field" => "tag",
            "key" => "user",
            "relation" => "=",
            "value" => $opponent[id]
        );

        $dados = array(
            "title" => "Seu Digimon ganhou uma batalha!",
            "message" => "Você ganhou de $challenger[name] na Tower of Valor, e você ganhou $money $ por causa disso :)",
            "filter" => $filter,
            "android" => true,
            "group" => "Tower of Valor Ganhou"
        );

        preparePush($dados);
    }

    $db->update("vms_user_has_valor", $userc);
    $db->update("vms_user_has_valor", $usero);

    if ($userc[battleTickets] == 0) {

        $afterDate = getAfterHour(2);

        $filter = array(
            "field" => "tag",
            "key" => "user",
            "relation" => "=",
            "value" => $opponent[id]
        );

        $dados = array(
            "title" => "Você já pode batalhar novamente!",
            "message" => "Você ganhou 10 tickets, já pode voltar a batalhar na Tower of Valor!",
            "filter" => $filter,
            "date" => date("Y-m-d H:i:s", $afterDate),
            "android" => true,
            "group" => "Tower of Valor Tickets"
        );

        preparePush($dados);
    }

}

print_r(pretty_json(json_encode($return)));

function getEffortUpgradeWin($monster)
{
    getEffortUpgrade($monster, 2);
}

function getEffortUpgradeLoss($monster)
{
    getEffortUpgrade($monster, 1);
}

function getEffortUpgrade($monster, $count)
{
    $db = new Database();
    $eu = $db->selectObject("vms_user_has_species", "WHERE id = '$monster[id]'");

    $upgrade = rand(1, 6);

    if ($upgrade == 1) {
        if (($monster[baseHp] * 4) > $eu[euHp]) $eu[euHp] = $eu[euHp] + $count;
    } else if ($upgrade == 2) {
        if (($monster[baseAtk] * 4) > $eu[euAtk]) $eu[euAtk] = $eu[euAtk] + $count;
    } else if ($upgrade == 3) {
        if (($monster[baseDef] * 4) > $eu[euDef]) $eu[euDef] = $eu[euDef] + $count;
    } else if ($upgrade == 4) {
        if (($monster[baseSpAtk] * 4) > $eu[euSpAtk]) $eu[euSpAtk] = $eu[euSpAtk] + $count;
    } else if ($upgrade == 5) {
        if (($monster[baseSpDef] * 4) > $eu[euSpDef]) $eu[euSpDef] = $eu[euSpDef] + $count;
    } else if ($upgrade == 6) {
        if (($monster[baseSpd] * 4) > $eu[euSpd]) $eu[euSpd] = $eu[euSpd] + $count;
    }

    $db->update("vms_user_has_species", $eu);
}

function atack($attacker, $advantage, $defender)
{
    $atk = 0;
    $def = 0;

    if ($attacker[atk] > $attacker[spatk]) {
        $atk = $attacker[atk];
        $def = $defender[def];
    } else if ($attacker[atk] == $attacker[spatk]) {
        if ($defender[def] >= $defender[spdef]) {
            $atk = $attacker[spatk];
            $def = $defender[spdef];
        } else {
            $atk = $attacker[atk];
            $def = $defender[def];
        }
    } else {
        $atk = $attacker[spatk];
        $def = $defender[spdef];
    }

    $atk = intval(getAdvantageNumber($atk));
    $def = intval(getAdvantageNumber($def));

    $atk = intval($atk + ($atk * $advantage / 100));

    $ratk = $atk - $def;
    if ($ratk <= 0) $ratk = 1;

    $hp = intval($defender[hp] - $ratk);

    if ($hp <= 0) $hp = 0;

    $defender[hp] = $hp;

    //echo "$attacker[name] atacou com $atk<br>";
    //echo "$defender[name] defendeu com $def<br><br>";
    //echo "$defender[name] levou $ratk de dano<br><br>";

    return $defender;
}

function getAdvantageNumber($num)
{
    $aMaior = $num + 20;
    $aMenor = $num - 20;

    $arand1 = rand($aMenor, $aMaior);
    $arand2 = rand($aMenor, $aMaior);
    $arand3 = rand($aMenor, $aMaior);

    $vant = max($arand1, $arand2, $arand3);
    $desv = min($arand1, $arand2, $arand3);

    $op = rand(1, 100);

    if ($op >= 51) $num = $vant;
    else $num = $desv;

    $critic = rand(1, 100);
    if ($critic <= 5) $num = $num * 2;

    return $num;
}

?>